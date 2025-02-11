<template>
  <DefaultLayout>
    <a-flex
      class="flex-1 justify-center items-center"
      vertical
      v-for="item in data"
      :key="item.id"
    >
      <a-flex class="item-name">
        {{ item.name }}
      </a-flex>
      <img
        v-if="item.image?.path"
        :src="item.image?.path"
        class="carousel-image"
      />
      <div v-html="item.description" class="carousel-description" />
      <!-- <span class="item-price">{{ item.price }}</span> -->
    </a-flex>
  </DefaultLayout>
</template>

<script setup>
import axios from "axios";
import DefaultLayout from "./DefaultLayout.vue";
import { onMounted, ref } from "vue";

const data = ref("");
const fetchData = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API}/products`
    );
    data.value = response.data;
    // console.log(response.data);
  } catch (e) {
    console.log("Error: ", e);
  }
};

onMounted(() => fetchData());
</script>
