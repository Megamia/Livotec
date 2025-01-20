<template>
  <div>
    <h1 class="text-[24px] font-semibold text-[#02b6ac]">Livotec-Công nghệ thông minh, sống khỏe mỗi ngày</h1>
    <a-tabs v-model:activeKey="activeKey" class="a">
      <a-tab-pane v-for="item in data" :key="item.id" :tab="item.name">
        {{ item.data }}
      </a-tab-pane>
    </a-tabs>
  </div>
</template>

<script setup>
import { ref } from "vue";

const activeKey = ref(1);

const data = ref([
  { id: 1, name: "Bếp từ", data: "a" },
  { id: 2, name: "Máy lọc nước", data: "b" },
  { id: 3, name: "Bình nước nóng", data: "c" },
  { id: 4, name: "Linh kiện, Lõi lọc", data: "d" },
]);
</script>

<style scoped>
.a::v-deep(.ant-tabs-tab) {
  margin: 0;
  padding-inline: 0.5rem;
}

.a::v-deep(.ant-tabs-nav .ant-tabs-tab-btn) {
  font-size: 16px;
  font-weight: 500;
}
</style>
