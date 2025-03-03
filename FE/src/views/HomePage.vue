<template>
  <a-flex class="flex-1 flex-col">
    <DefaultLayout>
      <HomeHeroSlideComponent />
      <NavProductComponent />
      <!-- <ProductComponent :categorySlug="'may-loc-nuoc'" /> -->
      <ProductComponent :categorySlug="'bep-tu'" />
    </DefaultLayout>
  </a-flex>
</template>

<script setup>
import HomeHeroSlideComponent from "@/components/HomeHeroSlideComponent.vue";
import DefaultLayout from "./DefaultLayout.vue";
import NavProductComponent from "@/components/NavProductComponent.vue";
import ProductComponent from "@/components/ProductComponent.vue";
// import { onMounted } from "vue";
// import store from "@/store/store";

// const fetchData=async()=>{
//   const dataProduct = store.getters["product/getDataStoreProduct"];
//   console.log();
  
// }

// onMounted(()=>fetchData());
</script>

<style scoped></style>
