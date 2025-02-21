<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <DefaultLayout>
    <a-flex vertical class="w-full mt-[50px] justify-center items-center">
      <ItemNavNewsComponent />
      <ItemLatestNewsComponent />
    </a-flex>
  </DefaultLayout>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import DefaultLayout from "../DefaultLayout.vue";
import "./news.css";
import ItemLatestNewsComponent from "@/components/news/latestNews/ItemLatestNewsComponent.vue";
import ItemNavNewsComponent from "@/components/news/navNews/ItemNavNewsComponent.vue";
</script>

<style scoped></style>
