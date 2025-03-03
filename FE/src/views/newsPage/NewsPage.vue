<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <DefaultLayout>
    <a-flex vertical class="w-full px-[125px] justify-center items-center">
      <a-flex
        class="py-[1rem] w-full text-[#38b6ac] text-[18px] border-b-[1px] border-[#dbe0f0] mb-3"
      >
        <span class="font-medium">Tin tức</span>
      </a-flex>
      <ItemNavNewsComponent />
      <ItemLatestNewsComponent />
    </a-flex>
  </DefaultLayout>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import DefaultLayout from "../layouts/DefaultLayout.vue";
import "./news.css";
import ItemLatestNewsComponent from "@/components/news/latestNews/ItemLatestNewsComponent.vue";
import ItemNavNewsComponent from "@/components/news/navNews/ItemNavNewsComponent.vue";
</script>

<style scoped></style>
