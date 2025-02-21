<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <a-flex class="w-full justify-center items-center gap-[50px]">
    <button
      v-if="data.length > 4"
      class="absolute flex w-[30px] h-[30px] rounded-[50%] text-black items-center justify-center top-[70%] left-[50px] bg-[#F3F3F3] border-[1px] border-[#b4b6b5]"
      @click="prevSlide"
    >
      <BsArrowLeft class="font-black" />
    </button>
    <a-flex class="max-w-[100%] px-[100px]">
      <swiper
        :slidesPerView="data.length > 0 ? Math.min(data.length, 4) : 1"
        :spaceBetween="30"
        :modules="modules"
        :loop="true"
        @swiper="onSwiper"
        :breakpoints="breakpoints"
        :navigation="false"
        class="swiperProduct"
      >
        <swiper-slide v-for="item in data" :key="item.id" class="w-[350px]">
          <a-flex vertical class="bg-[#EDEDED] rounded-lg flex-1 h-[500px] w-[300px]">
            <!-- <a-flex
            v-for="item in data"
            :key="item.id"
            class="w-[100%] max-w-[350px]"
          > -->
            <a-flex vertical class="w-full ">
              <img
                :src="item.image_url || defaultImage"
                class="w-[100%] h-[270px] object-cover"
              />
              <a-flex
                vertical
                class="w-[100%] p-[15px] gap-[10px] bg-[#ededed]"
              >
                <a-flex class="text-[#6d6d6d] text-start items-center gap-[3px] h-[20px]">
                  <AkClock /> {{ formatDate(item.published_at)?formatDate(item.published_at):"No data" }}
                </a-flex>

                <span
                  class="contentHtmlSpan2Text text-black text-start font-normal leading-[23px] min-h-[50px]"
                >
                  {{ item.title }}
                </span>
                <span
                  class="contentHtmlSpan3Text text-[16px] text-start text-black font-normal h-[72px]"
                >
                  {{ truncateText(item.content_html) }}
                </span>
                <a
                  :href="`/detailNews/${item.slug}`"
                  class="text-[#0d6efd] hover:bg-[#ededed] hover:text-[#02B6AC] text-start"
                >
                  Đọc tiếp</a
                >
              </a-flex>
            </a-flex>
            <!-- </a-flex> -->
          </a-flex>
        </swiper-slide>
      </swiper>
    </a-flex>
    <button
      v-if="data.length > 4"
      class="absolute flex w-[30px] h-[30px] rounded-[50%] text-black items-center justify-center top-[70%] right-[50px] bg-[#F3F3F3] border-[1px] border-[#b4b6b5]"
      @click="nextSlide"
    >
      <BsArrowRight class="font-black" />
    </button>
  </a-flex>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import axios from "axios";
import dayjs from "dayjs";
import { onMounted, ref } from "vue";
import { AkClock } from "@kalimahapps/vue-icons";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation } from "swiper";
import "swiper/css";
import "swiper/css/navigation";
import "./NavProductComponent.css";
import { BsArrowLeft, BsArrowRight } from "@kalimahapps/vue-icons";

const modules = [Navigation];

const data = ref([]);
const defaultImage =
  "https://livotec.com/wp-content/uploads/2024/11/Binh-tam-nong-lanh-%E2%80%93-Giai-phap-hoan-hao-cho-ngoi-nha-hien-dai.jpg";

const fetchData = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_POST}/allPost`
    );
    data.value = response.data.data;
    console.log(response.data);
  } catch (e) {
    console.log("Error: ", e);
  }
};

onMounted(() => fetchData());
const truncateText = (htmlContent) => {
  if (!htmlContent) return "";

  const tempElement = document.createElement("div");
  tempElement.innerHTML = htmlContent;
  tempElement.querySelectorAll("img").forEach((img) => img.remove());

  return tempElement.textContent.trim().split("\n")[0];
};

const formatDate = (date) => {
  return date ? dayjs(date).format("DD/MM/YYYY") : "";
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
.contentHtmlSpan2Text {
  font-size: calc(1.275rem + 0.3vw);
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  max-width: 100%;
}

.contentHtmlSpan3Text {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  max-width: 100%;
}
</style>
