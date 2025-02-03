<template>
  <DefaultLayout>
    <div class="container">
      <div class="w-full border-b-[1px] border-gray-300 py-3 mb-4">
        <span class="text-[#38B6AC] font-bold">So sánh sản phẩm</span>
      </div>
      <div class="w-full flex justify-center items-center">
        <h1 class="text-[#38B6AC] font-bold text-3xl">SO SÁNH SẢN PHẨM</h1>
      </div>
      <div class="product-comparison">
        <table>
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th>Xóa</th>
              <th>Xóa</th>
            </tr>
            <tr>
              <th>TÊN</th>
              <th>GIÁ</th>
              <th>ID</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in specs" :key="item.id">
              <td>{{ item.name }}</td>
              <td>{{ item.price }}</td>
              <td>{{ item.id }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "./DefaultLayout.vue";
import { ref, onMounted } from "vue";
import store from "@/store/store";

const specs = ref([]);

onMounted(() => fetchData());

const fetchData = () => {
  const dataStore = store.getters["product/getDataStoreProducts"];
  if (dataStore && dataStore.length > 0) {
    specs.value = dataStore;
    console.log(specs.value);
  }
};
</script>

<style scoped>
.product-comparison table {
  border: 1px solid #dddddd;
}
.product-comparison th,
.product-comparison td {
  border: 1px solid #dddddd;
}
</style>
