<template>
  <a-flex class="flex-1 flex-col">
    <DefaultLayout>
      <HomeHeroSlideComponent />
      <NavProductComponent />
      <ProductComponent :categoryId="1" />
      <ProductComponent :categoryId="2" />
    </DefaultLayout>
  </a-flex>
</template>

<script setup>
import HomeHeroSlideComponent from "@/components/HomeHeroSlideComponent.vue";
import DefaultLayout from "./DefaultLayout.vue";
import NavProductComponent from "@/components/NavProductComponent.vue";
import ProductComponent from "@/components/ProductComponent.vue";
</script>

<style scoped></style>
