<template>
  <swiper
    :pagination="{
      clickable: true,
    }"
    :modules="modules"
    class="mySlide max-w-[100%]"
  >
    <swiper-slide>
      <img
        src="https://livotec.com/wp-content/uploads/2025/01/bep-dien-tu-livotec-banner-pc.jpg"
      />
    </swiper-slide>
    <swiper-slide>
      <img
        src="https://livotec.com/wp-content/uploads/2024/12/CoverTet2025-Livotec-CTKM-PC.jpg"
      />
    </swiper-slide>
    <swiper-slide>Slide 2</swiper-slide>
    <swiper-slide>Slide 3</swiper-slide>
    <swiper-slide>Slide 4</swiper-slide>
    <swiper-slide>Slide 5</swiper-slide>
    <swiper-slide>Slide 6</swiper-slide>
    <swiper-slide>Slide 7</swiper-slide>
    <swiper-slide>Slide 8</swiper-slide>
  </swiper>
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";

import { Pagination } from "swiper";
import "swiper/css";
import "swiper/css/pagination";

const modules = [Pagination];
</script>

<style scoped>
.mySlide::v-deep(.swiper-pagination) {
  width: auto;
  display: flex;
  gap: 15px;
  border-radius: 15px;
  background: #f5f1f1;
  padding: 12px 15px;
  bottom: 24px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 2;
}
.mySlide::v-deep(.swiper-pagination-bullet) {
  background-color: #706a6a;
  opacity: 1;
}

.mySlide::v-deep(.swiper-pagination-bullet-active),
.mySlide::v-deep(.swiper-pagination-bullet):hover {
  background-color: #5893ed;
}
</style>
