<template>
  <a-flex vertical align="center" class="w-[100%]">
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

    <a-flex v-if="haveData" class="max-w-[100%] px-[100px] py-[30px]">
      <swiper
        :slides-per-view="Math.min(dataChil.length, 4)"
        :spaceBetween="20"
        :modules="modules"
        :navigation="true"
      >
        <swiper-slide v-for="itemChil in dataChil" :key="itemChil.id">
          <a-flex vertical class="flex-1 bg-[#F3F4F6]">
            <div
              class="absolute bg-gradient-to-r from-black/50 to-black/50 w-full text-white p-2"
            >
              <div v-html="itemChil.description" class="h-[180px] "/>
            </div>
            <a-flex vertical align="center" class="flex-1 py-[20px]">
              <img
                src="https://livotec.com/wp-content/uploads/2024/11/bep-tu-don-livotec-826-300x300.png"
              />
              <a-flex class="px-[10px] w-[100%]">
                <a-flex gap="12" vertical class="flex-1">
                  <span class="text-[16px] font-bold">
                    {{ itemChil.name }}
                  </span>
                  <span class="text-[16px] font-bold text-[#02B6AC]">
                    {{ itemChil.price }}
                  </span>
                  <a-flex vertical class="gap-[10px] text-[16px] font-bold">
                    <button
                      class="flex-1 px-[12px] py-[10px] rounded-[9999px] text-white bg-[linear-gradient(270deg,_#e20008_0%,_rgba(226,_0,_8,_0.7)_100%,_rgba(226,_0,_8,_0.68)_100%)] shadow-[#ff0000] shadow-sm"
                    >
                      Mua ngay
                    </button>

                    <button
                      class="flex-1 font-sans px-[12px] py-[10px] rounded-[9999px] text-white bg-[#02b6ac]"
                    >
                      Chi tiết
                    </button>
                  </a-flex>
                </a-flex>
              </a-flex>
            </a-flex>
            <!-- <div class="relative">
              <img src="../../../../../../Downloads/429480182_1083868169326367_8227484725033197706_n.png"/>
            </div>
            <a-flex>
              <div>Tên: {{ itemChil.name }}</div>
              <div>Giá: {{ itemChil.price }}</div>
            </a-flex> -->
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
      console.log(dataChil.value);

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

<style scoped>
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
