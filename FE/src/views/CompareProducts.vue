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
          </thead>
          <tbody>
            <tr>
              <td>Tên sản phẩm</td>
              <td v-for="(item, index) in specs" :key="index">
                {{ item.name }}
              </td>
            </tr>
            <tr>
              <td>Giá</td>
              <td v-for="(item, index) in specs" :key="index">
                {{ item.price }}
              </td>
            </tr>
            <tr>
              <td>Mô tả</td>
              <td v-for="(item, index) in specs" :key="index">
                <div v-html="item.description" class="description" />
              </td>
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

<style>
.description ul {
  list-style: none;
  padding: 0;
}

.description ul li {
  position: relative;
  padding-left: 1.5em;
  margin-top: 10px;
}

.description ul li::before {
  content: "•";
  color: #38b6ac;
  font-size: 1.5em;
  position: absolute;
  left: 0;
  top: -5px;
}
</style>
