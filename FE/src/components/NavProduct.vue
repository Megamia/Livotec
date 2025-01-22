<template>
  <a-flex vertical align="center">
    <h1 class="text-[24px] font-semibold text-[#02b6ac]">
      Livotec - Công nghệ thông minh, sống khỏe mỗi ngày
    </h1>
    <a-flex>
      <a-tabs v-model:data="activeKey" class="a" @change="changeData">
        <a-tab-pane
          v-for="item in data"
          :key="item.id"
          :tab="item.name"
          class="flex gap-[10px]"
        >
        </a-tab-pane>
      </a-tabs>
    </a-flex>

    <a-flex v-if="haveData" gap="10px" class="w-[900px]">
        <swiper
          :slidesPerView="4"
          :navigation="true"
          :modules="modules"
          class="max-w-[1000px] mySlide"
        >
          <swiper-slide>
            <a-flex vertical v-for="itemChil in dataChil" :key="itemChil.id">
              <div>Tên: {{ itemChil.name }}</div>
              <div>Giá: {{ itemChil.price }}</div>
            </a-flex>
          </swiper-slide>
          <!-- <swiper-slide>1</swiper-slide>
          <swiper-slide>2</swiper-slide>
          <swiper-slide>3</swiper-slide>
          <swiper-slide>4</swiper-slide>
          <swiper-slide>5</swiper-slide> -->
        </swiper>

      <!-- <a-flex v-for="itemChil in dataChil" :key="itemChil.id" class="item">
        <a-flex vertical>
          <div>ID: {{ itemChil.id }}</div>
          <div>Tên: {{ itemChil.name }}</div>
          <div>Giá: {{ itemChil.price }}</div>
          <div v-html="itemChil.description" class="test"></div>
        </a-flex>
      </a-flex> -->
    </a-flex>
    <div v-else>Không có dữ liệu để hiển thị</div>
  </a-flex>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/vue";

import "swiper/css";

import "swiper/css/navigation";

import "./NavProduct.css";

import { Navigation } from "swiper";
const modules = [Navigation];
const activeKey = ref(1);
const haveData = ref(false);
const data = ref([
  { id: 1, name: "Bếp từ" },
  { id: 2, name: "Máy lọc nước" },
  { id: 3, name: "Bình nước nóng" },
  { id: 4, name: "Linh kiện, Lõi lọc" },
]);
const dataChil = ref([]);

const changeData = async (id) => {
  activeKey.value = id; // Cập nhật tab hiện tại
  await fetchData(id);
};

const fetchData = async (id) => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/products/${id}`
    );
    if (response.data && response.data.length > 0) {
      dataChil.value = response.data;
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

onMounted(() => fetchData(activeKey.value));
</script>

<style>
.a::v-deep(.ant-tabs-tab) {
  margin: 0;
  padding-inline: 0.5rem;
}

.a::v-deep(.ant-tabs-nav .ant-tabs-tab-btn) {
  font-size: 18px;
  font-weight: 500;
}

.test ul li::before {
  content: "•";
  margin-right: 0.5rem;
  color: black;
  position: absolute;
  left: 0;
  top: 0;
}
.test ul li {
  position: relative;
  padding-left: 10px;
}
</style>
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
