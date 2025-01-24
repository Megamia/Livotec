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
          <thead></thead>
          <tbody>
            <tr v-for="spec in specs" :key="spec.thuoc_tinh">
              <td>{{ spec.thuoc_tinh }}</td>
              <td>{{ getSpecValue(products[0], spec.thuoc_tinh) }}</td>
              <td>{{ getSpecValue(products[1], spec.thuoc_tinh) }}</td>
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


</script>

<style scoped>
</style>
