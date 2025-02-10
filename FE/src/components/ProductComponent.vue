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
                  class="absolute bg-[#ffdc37] top-[20px] right-0 rounded-l-md label z-10"
                >
                  <span class="text-[20px] text-white">Bán chạy nhất</span>
                </div>
                <div
                  v-else
                  class="absolute bg-[#e20008] top-[20px] right-0 rounded-l-md label z-10"
                >
                  <span class="text-[20px] text-white">Mới nhất</span>
                </div>
                <div
                  class="absolute cursor-pointer h-[100%] top-0 w-[100%] bg-gradient-to-r from-black/50 to-black/50 text-white p-2 description rounded-t-lg z-20"
                >
                  <div
                    v-html="itemChil.description"
                    class="max-h-[90%] overflow-y-scroll text-left test"
                  />
                </div>
              </div>
              <a-flex class="px-[10px] w-[70%] text-center">
                <a-flex gap="12" vertical class="flex-1">
                  <span
                    class="text-[16px] font-bold w-[100%] hover:text-[#02B6AC] cursor-pointer"
                  >
                    {{ itemChil.name ? itemChil.name : "Null" }}
                  </span>
                  <span class="text-[16px] font-bold text-[#02B6AC]">
                    {{ itemChil.price ? itemChil.price : "Null" }}
                  </span>
                  <a-flex vertical class="gap-[10px] text-[16px]">
                    <button
                      class="flex-1 font-bold px-[12px] py-[10px] rounded-[9999px] text-white hover:bg-[#CC020B] bg-[linear-gradient(270deg,_#e20008_0%,_rgba(226,_0,_8,_0.7)_100%,_rgba(226,_0,_8,_0.68)_100%)] shadow-[#ff0000] shadow-sm"
                    >
                      Mua ngay
                    </button>

                    <button
                      class="flex-1 font-sans border-[1px] border-[#4fa8e7] px-[12px] py-[10px] rounded-full text-white bg-[#02b6ac] hover:bg-[linear-gradient(270deg,_#ccf7fb_2.05%,_#fff_100%)] hover:text-[#424242]"
                      @click="test(itemChil.slug)"
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
const dataChil = ref([]);
const haveData = ref(false);
const props = defineProps({
  categoryId: [String, Number],
});
const nameCategory = ref("");
const pathImg = ref("");
const fetchData = async () => {
  console.log(props.categoryId);

  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/navProducts/${
        props.categoryId
      }`
    );
    console.log(response.data);

    if (response.data) {
      console.log(response.data);

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

<style scoped></style>
