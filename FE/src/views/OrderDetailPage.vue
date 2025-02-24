<template>
  <DefaultLayout>
    <div class="container mb-[3rem]">
      <div class="w-full border-b-[1px] border-gray-300 py-3">
        <span class="text-[#38B6AC] font-bold">Thanh toán</span>
      </div>
      <div>
        <h1 class="text-3xl text-[#38B6AC] font-bold my-3">Thanh toán</h1>
        <div
          id="app"
          class="flex flex-col md:flex-row justify-between items-center p-4"
        >
          <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
            <span class="text-xs font-bold">ORDER NUMBER:</span>
            <span class="text-lg font-bold">{{ orderNumber }}</span>
          </div>
          <div class="dot-separator hidden md:flex">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
            <span class="text-xs font-bold">DATE:</span>
            <span class="text-lg font-bold">{{ date }}</span>
          </div>
          <div class="dot-separator hidden md:flex">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
            <span class="text-xs font-bold">TOTAL:</span>
            <span class="text-lg font-bold text-teal-500">{{ total }}</span>
          </div>
          <div class="dot-separator hidden md:flex">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <div class="flex flex-col items-center md:items-start">
            <span class="text-xs font-bold">PAYMENT METHOD:</span>
            <span class="text-lg font-bold">{{ paymentMethod }}</span>
          </div>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "./DefaultLayout.vue";
</script>

<style scoped>
.dot-separator {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 0 16px;
}
.dot-separator div {
  width: 4px;
  height: 4px;
  background-color: gray;
  border-radius: 50%;
  margin: 2px 0;
}
</style>
