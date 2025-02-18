<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <a-flex vertical align="center" class="w-full">
    <h1 class="text-[24px] font-semibold text-[#02b6ac]">
      Livotec - Công nghệ thông minh, sống khỏe mỗi ngày
    </h1>
    <a-flex class="max-w-[100%]">
      <a-tabs
        v-model:data="activeKey"
        class="nav max-w-[100%]"
        @change="changeData"
      >
        <a-tab-pane
          v-for="item in validateCategory"
          :key="item.slug"
          :tab="item.name"
          class="flex gap-[10px]"
        >
        </a-tab-pane>
      </a-tabs>
    </a-flex>

    <a-flex
      v-if="haveData && dataChil.length > 0"
      class="max-w-[100%] w-full px-[100px] py-[30px] justify-center relative"
    >
      <button
        class="absolute flex w-[30px] h-[30px] rounded-[50%] text-black items-center justify-center top-[50%] left-[50px] bg-[#F3F3F3] border-[1px] border-[#b4b6b5]"
        @click="prevSlide"
      >
        <BsArrowLeft class="font-black" />
      </button>
      <swiper
        :slidesPerView="dataChil.length > 0 ? Math.min(dataChil.length, 4) : 1"
        :spaceBetween="30"
        :modules="modules"
        @swiper="onSwiper"
        :breakpoints="breakpoints"
        :navigation="false"
        class="swiperProduct"
      >
        <swiper-slide
          v-for="itemChil in dataChil"
          :key="itemChil.id"
          class="w-[350px]"
        >
          <a-flex vertical class="bg-[#F3F4F6] rounded-lg pb-[20px] w-full">
            <a-flex vertical align="center" class="flex-1">
              <div class="w-full relative pt-[20px] justify-center flex">
                <img
                  :src="
                    itemChil.image?.path ||
                    'https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty-300x240.jpg'
                  "
                  class="w-[300px] h-[300px]  justify-center items-center"
                />
                <div
                  class="absolute bg-[#e20008] top-[20px] right-0 rounded-l-md label z-10"
                >
                  <span class="text-[20px] text-white">Mới nhất</span>
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
              <a-flex class="px-[10px] w-[70%]">
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
        </swiper-slide>
      </swiper>
      <button
        class="absolute flex w-[30px] h-[30px] rounded-[50%] text-black items-center justify-center top-[50%] right-[50px] bg-[#F3F3F3] border-[1px] border-[#b4b6b5]"
        @click="nextSlide"
      >
        <BsArrowRight class="font-black" />
      </button>
    </a-flex>
    <div v-else>Không có dữ liệu để hiển thị</div>
  </a-flex>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "./NavProductComponent.css";
import { Navigation } from "swiper";
import { useRouter } from "vue-router";
import { BsArrowLeft, BsArrowRight } from "@kalimahapps/vue-icons";

const modules = [Navigation];
const slugsToFilter = ["bep-tu", "may-loc-nuoc", "linh-kien-loi-loc"];
const activeKey = ref(slugsToFilter[0]);

const haveData = ref(false);
const router = useRouter();

const fetchDataCategory = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_CATEGORY}/allCategory`
    );
    data.value = response.data.data1;
    filterData(data.value);
  } catch (e) {
    console.log("Error: ", e);
  }
};

onMounted(() => fetchDataCategory());
const dataChil = ref([]);

const formatCurrency = (value) => {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(value);
};

const handleProductDetail = (items) => {
  router.push(`/product/${items}`);
};

const changeData = async (slug) => {
  activeKey.value = slug;
  await fetchData(slug);
};

const data = ref([]);

const fetchData = async (slug) => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/navProducts/${slug}`
    );
    if (response.data) {
      dataChil.value = response.data.products;
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

const validateCategory = ref([]);

const categoryOrder = {
  "bep-tu": 1,
  "may-loc-nuoc": 2,
  "linh-kien-loi-loc": 3,
};

const filterData = (data) => {
  validateCategory.value = data
    .filter((item) => slugsToFilter.includes(item.slug))
    .map((item) => ({
      ...item,
      order: categoryOrder[item.slug] || 0,
    }))
    .sort((a, b) => a.order - b.order);
  if (validateCategory.value.length <= 0) {
    console.log("Không có data");
  }
};

const swiperInstance = ref(null);

const onSwiper = (swiper) => {
  swiperInstance.value = swiper;
};

const prevSlide = () => {
  if (swiperInstance.value) swiperInstance.value.slidePrev();
};

const nextSlide = () => {
  if (swiperInstance.value) swiperInstance.value.slideNext();
};

onMounted(() => fetchData(activeKey.value));

const breakpoints = {
  0: {
    slidesPerView: 1,
  },
  580: {
    slidesPerView: 2,
  },
  876: {
    slidesPerView: 3,
  },
  1200: {
    slidesPerView: 4,
  },
};
</script>

<style scoped>
.nav::v-deep(.ant-tabs-tab) {
  margin: 0;
  padding-inline: 0.5rem;
  padding-inline: 16px;
}

.nav::v-deep(.ant-tabs-nav .ant-tabs-tab-btn) {
  font-size: 18px;
  font-weight: 500;
}
</style>

<style>
.test {
  padding: 10px 20px;
}

.test ul li::before {
  content: "•";
  margin-right: 0.5rem;
  position: absolute;
  left: 0;
  top: 0;
}
.test ul li {
  position: relative;
  padding-left: 10px;
  color: white;
}
.test::-webkit-scrollbar {
  width: 5px;
}

.test::-webkit-scrollbar-track {
  background: #9b9b9c;
  border-radius: 4px;
}
.test::-webkit-scrollbar-thumb {
  background: #f0f0f0;
  border-radius: 4px;
}

.test::-webkit-scrollbar-thumb:hover {
  background: #f0f0f0;
}
</style>
