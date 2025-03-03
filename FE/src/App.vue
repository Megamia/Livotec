<script setup>
import { RouterView } from "vue-router";
import { onMounted, onUnmounted } from "vue";
import {
  saveDataToIndexedDB,
  getDataFromIndexedDB,
  getAllDataFromIndexedDB,
} from "./store/indexedDB";
import axios from "axios";
let timeoutId;

onMounted(() => {
  const tokenTimestamp = localStorage.getItem("tokenTimestamp");
  const currentTime = Date.now();

  if (tokenTimestamp && currentTime - tokenTimestamp >= 3600000) {
    localStorage.removeItem("token");
    localStorage.removeItem("tokenTimestamp");
  } else {
    timeoutId = setTimeout(() => {
      localStorage.removeItem("token");
      localStorage.removeItem("tokenTimestamp");
    }, 3600000 - (currentTime - tokenTimestamp || 0));
  }

  if (!tokenTimestamp) {
    localStorage.setItem("tokenTimestamp", Date.now());
  }
});

onUnmounted(() => {
  clearTimeout(timeoutId);
});

const fetchData1 = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/allProduct`
    );

    if (response.data.status === 1) {
      const products = response.data.allProduct.map((product) => ({
        ...product,
        image: product.image?.path || "",
      }));
      return { data: products, timestamp: Date.now() };
    } else {
      return { data: [], timestamp: Date.now() };
    }
  } catch (e) {
    console.log("Error: ", e);
    return { data: [], timestamp: Date.now() };
  }
};

const fetchDataCategory = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_CATEGORY}/allCategory`
    );

    if (response.data.status === 1) {
      return { data: response.data.allCategory, timestamp: Date.now() };
    } else {
      return { data: [], timestamp: Date.now() };
    }
  } catch (e) {
    console.log("Error: ", e);
    return { data: [], timestamp: Date.now() };
  }
};

const fetchData2 = async () => {
  let localData = await getDataFromIndexedDB("products");
  let categoryData = await getDataFromIndexedDB("category");

  if (localData.length === 0 || categoryData.length === 0) {
    const apiData = await fetchData1();
    const apiCategory = await fetchDataCategory();

    if (apiCategory.length > 0) {
      await saveDataToIndexedDB("category", apiCategory);
      categoryData = apiCategory;
    }

    if (apiData.length > 0) {
      await saveDataToIndexedDB("products", apiData);
      localData = apiData;
    }
  }

  return { products: localData, categories: categoryData };
};

onMounted(async () => {
  await fetchData2();
  const { products, categories } = await fetchData2();
  // console.log("Products:", products);
  // console.log("Categories:", categories);
});

const fetchDataWithTimestamp = async () => {
  try {
    const categoryData = await getDataFromIndexedDB("category");
    const productData = await getDataFromIndexedDB("products");

    const newCategoryData = await fetchDataCategory();
    const newProductData = await fetchData1();

    console.log(
      "productData: ,",
      productData,
      "\n",
      "newProductData: ",
      newProductData
    );

    const isCategoryChanged =
      JSON.stringify(categoryData) !== JSON.stringify(newCategoryData.data);
    const isProductChanged =
      JSON.stringify(productData) !== JSON.stringify(newProductData.data);

    if (isCategoryChanged || isProductChanged) {
      console.log("⏳ Dữ liệu thay đổi, đang cập nhật...");

      if (isCategoryChanged) {
        await saveDataToIndexedDB("category", newCategoryData.data);
      }

      if (isProductChanged) {
        await saveDataToIndexedDB("products", newProductData.data);
      }

      localStorage.setItem("lastUpdated", Date.now());
      console.log("✅ Dữ liệu đã được cập nhật!");
    } else {
      console.log("✅ Dữ liệu không thay đổi, giữ nguyên.");
    }
  } catch (error) {
    console.error("❌ Lỗi khi tải dữ liệu:", error);
  }
};

onMounted(() => {
  fetchDataWithTimestamp();
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
    <RouterView />
  </a-config-provider>
</template>

<style scoped></style>
