<template>
  <a-flex vertical class="px-[100px]">
    <img :src="pathImg" class="w-[100%] bg-red-500 mb-5" />
    <a-flex justify="center" vertical class="gap-[40px]">
      <span
        class="text-[28px] text-[#02b6ac] font-bold uppercase text-center"
        >{{ nameCategory }}</span
      >
      <a-flex horizontal>
        <a-flex
          v-for="itemChil in dataChil.slice(0, 4)"
          :key="itemChil.id"
          class="mx-[10px]"
        >
          <a-flex vertical class="bg-[#F3F4F6] rounded-lg pb-[20px] w-full">
            <a-flex vertical align="center" class="flex-1">
              <div class="w-full relative pt-[20px] justify-center flex">
                <img
                  src="https://livotec.com/wp-content/uploads/2024/11/bep-tu-don-livotec-826-300x300.png"
                />
                <div
                  v-if="itemChil.sold_out >= 10"
                  class="absolute bg-[#ffdc37] top-[20px] right-0 rounded-l-md z-10 bestseller"
                >
                  <span class="text-black"
                    >Bán chạy <br />
                    nhất</span
                  >
                </div>
                <div
                  v-else
                  class="absolute bg-[#e20008] top-[20px] right-0 rounded-l-md label z-10 new"
                >
                  <span class="font-bold text-white">Mới nhất</span>
                </div>
                <div
                  class="absolute cursor-pointer h-[100%] top-0 w-[100%] bg-gradient-to-r from-black/50 to-black/50 text-white p-2 description-nav rounded-t-lg z-20"
                >
                  <div
                    v-html="
                      itemChil.description
                        ? itemChil.description
                        : 'Chưa có mô tả'
                    "
                    class="max-h-[90%] overflow-y-scroll text-left test"
                  />
                </div>
              </div>
              <a-flex class="px-[10px] w-[70%] text-center max-w-[200px]">
                <a-flex gap="12" vertical class="flex-1 max-w-[100%]">
                  <span
                    class="text-[16px] font-bold w-[100%] hover:text-[#02B6AC] cursor-pointer text-ellipsis overflow-hidden whitespace-nowrap"
                  >
                    {{ itemChil.name ? itemChil.name : "Chưa có tên" }}
                  </span>
                  <span class="text-[16px] font-bold text-[#02B6AC]">
                    {{
                      itemChil.price
                        ? formatCurrency(itemChil.price)
                        : "Chưa có giá"
                    }}
                  </span>
                  <a-flex vertical class="gap-[10px] text-[16px]">
                    <button
                      class="flex-1 font-bold px-[12px] py-[10px] rounded-[9999px] text-white hover:bg-[#CC020B] bg-[linear-gradient(270deg,_#e20008_0%,_rgba(226,_0,_8,_0.7)_100%,_rgba(226,_0,_8,_0.68)_100%)] shadow-[#ff0000] shadow-sm"
                    >
                      Mua ngay
                    </button>

                    <button
                      class="flex-1 font-sans border-[1px] border-[#4fa8e7] px-[12px] py-[10px] rounded-full text-white bg-[#02b6ac] hover:bg-[linear-gradient(270deg,_#ccf7fb_2.05%,_#fff_100%)] hover:text-[#424242]"
                      @click="handleProductDetail(itemChil.slug)"
                    >
                      Chi tiết
                    </button>
                  </a-flex>
                </a-flex>
              </a-flex>
            </a-flex>
          </a-flex>
        </a-flex>
      </a-flex>
    </a-flex>
  </a-flex>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref, defineProps } from "vue";
import { useRouter } from "vue-router";
import "./ProductComponent.css";

const router = useRouter();
const dataChil = ref([]);
const haveData = ref(false);
const props = defineProps({
  categoryId: [String, Number],
});
const nameCategory = ref("");
const pathImg = ref("");

const formatCurrency = (value) => {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(value);
};

const handleProductDetail = (items) => {
  router.push(`/product/${items}`);
};
const fetchData = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/navProducts/${
        props.categoryId
      }`
    );

    if (response.data) {
      //   dataChil.value = response.data.products?.length
      //     ? response.data.products.sort((a, b) => b.sold_out - a.sold_out)
      //     : [];

      //   dataChil.value = response.data.products?.length
      // ? response.data.products : [];

      dataChil.value = response.data.products?.length
        ? response.data.products.sort(() => 0.5 - Math.random()).slice(0, 4)
        : [];

      nameCategory.value = response.data.category.name;
      pathImg.value = response.data.category.image?.path;
      haveData.value = true;
    } else {
      dataChil.value = [];
      haveData.value = false;
    }
  } catch (e) {
    console.error("Error fetching data:", e);
    dataChil.value = [];
    haveData.value = false;
  }
};

onMounted(() => fetchData());
</script>

<style scoped>
.bestseller span::after {
  content: "";
  display: block;
  width: 0;
  height: 0;
  border-right: 10px solid #e3c849;
  border-bottom: 10px solid transparent;
  position: absolute;
  bottom: -10px;
  right: 0;
}

.bestseller span {
  text-align: center;
  font-size: 14px;
  line-height: 13px;
  font-weight: 700;
  min-height: 38px;
  justify-content: center;
  display: flex;
  padding: 7px 10px;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  position: relative;
}
</style>
