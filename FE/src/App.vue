<script setup>
import layouts from "./views/layouts";
import { RouterView, useRoute } from "vue-router";
import { computed, onMounted, onUnmounted } from "vue";
import { saveDataToIndexedDB, getDataFromIndexedDB } from "./store/indexedDB";
import axios from "axios";

const route = useRoute();
const layout = computed(() => layouts[route.meta.layout] || layouts.default);

let timeoutId;

// Xử lý token
const handleToken = () => {
  const tokenTimestamp = localStorage.getItem("tokenTimestamp");
  const currentTime = Date.now();
  const timeElapsed = tokenTimestamp ? currentTime - tokenTimestamp : 0;
  const oneHour = 3600000;

  if (!tokenTimestamp || timeElapsed >= oneHour) {
    localStorage.removeItem("token");
    localStorage.removeItem("tokenTimestamp");
    localStorage.setItem("tokenTimestamp", Date.now());
  } else {
    timeoutId = setTimeout(() => {
      localStorage.removeItem("token");
      localStorage.removeItem("tokenTimestamp");
    }, oneHour - timeElapsed);
  }
};

// Lấy dữ liệu sản phẩm từ API
const fetchData1 = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/allProduct`
    );
    return response.data.status === 1
      ? response.data.allProduct.map((product) => ({
          ...product,
          image: product.image?.path || "",
        }))
      : [];
  } catch (e) {
    console.error("Error fetching products:", e);
    return [];
  }
};

// Lấy dữ liệu danh mục từ API
const fetchDataCategory = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_CATEGORY}/allCategory`
    );
    return response.data.status === 1 ? response.data.allCategory : [];
  } catch (e) {
    console.error("Error fetching categories:", e);
    return [];
  }
};

// Kiểm tra và cập nhật dữ liệu nếu cần
const updateDataIfNeeded = async () => {
  try {
    const [localProducts, localCategories] = await Promise.all([
      getDataFromIndexedDB("products"),
      getDataFromIndexedDB("category"),
    ]);

    const [apiProducts, apiCategories] = await Promise.all([
      fetchData1(),
      fetchDataCategory(),
    ]);
    const removeTimestamp = (obj) => {
      const { timestamp, ...rest } = obj;
      return rest;
    };

    const isProductChanged =
      localProducts.length !== apiProducts.length ||
      localProducts.some((localItem) => {
        const apiItem = apiProducts.find(
          (apiItem) => apiItem.id === localItem.id
        );
        return (
          !apiItem ||
          JSON.stringify(removeTimestamp(localItem)) !==
            JSON.stringify(removeTimestamp(apiItem))
        );
      });

    const isCategoryChanged =
      localCategories.length !== apiCategories.length ||
      localCategories.some((localItem) => {
        const apiItem = apiCategories.find(
          (apiItem) => apiItem.id === localItem.id
        );
        return (
          !apiItem ||
          JSON.stringify(removeTimestamp(localItem)) !==
            JSON.stringify(removeTimestamp(apiItem))
        );
      });

    if (isProductChanged) await saveDataToIndexedDB("products", apiProducts);
    if (isCategoryChanged) await saveDataToIndexedDB("category", apiCategories);

    if (isProductChanged || isCategoryChanged) {
      // console.log("Dữ liệu thay đổi");

      localStorage.setItem("lastUpdated", Date.now());
    }
    //  else {
    //   console.log("Dữ liệu giữ nguyên");
    // }
  } catch (error) {
    console.error("❌ Lỗi khi cập nhật dữ liệu:", error);
  }
};

onMounted(async () => {
  handleToken();
  await updateDataIfNeeded();
});

onUnmounted(() => {
  clearTimeout(timeoutId);
});
</script>

<template>
  <a-config-provider
    :theme="{
      token: {
        colorPrimary: '#02B6AC',
      },
    }"
  >
    <component :is="layout">
      <router-view />
    </component>
  </a-config-provider>
</template>

<style scoped></style>
