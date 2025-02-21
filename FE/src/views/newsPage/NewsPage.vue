<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <DefaultLayout>
    <a-flex vertical class="w-full mt-[50px] justify-center items-center">
      <ItemLatestNews />
    </a-flex>
  </DefaultLayout>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import { onMounted, ref } from "vue";
import DefaultLayout from "../DefaultLayout.vue";
import "./news.css";
import axios from "axios";
import ItemLatestNews from "./latestNews/ItemLatestNews.vue";
</script>

<style scoped></style>
