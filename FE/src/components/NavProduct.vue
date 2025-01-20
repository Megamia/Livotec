<template>
  <a-flex vertical align="center">
    <h1 class="text-[24px] font-semibold text-[#02b6ac]">
      Livotec-Công nghệ thông minh, sống khỏe mỗi ngày
    </h1>
    <a-tabs v-model:activeKey="activeKey" class="a">
      <a-tab-pane v-for="item in data" :key="item.id" :tab="item.name">
        <a-flex>
          {{ item.data }}
        </a-flex>
      </a-tab-pane>
    </a-tabs>
  </a-flex>
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
  font-size: 18px;
  font-weight: 500;
}
</style>
