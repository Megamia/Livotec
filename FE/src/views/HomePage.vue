<template>
  <a-flex class="flex-1 flex-col">
    <DefaultLayout>
      <HomeHeroSlideComponent />
      <NavProduct/>
    </DefaultLayout>
  </a-flex>
</template>

<script setup>
import HomeHeroSlideComponent from "@/components/HomeHeroSlideComponent.vue";
import DefaultLayout from "./DefaultLayout.vue";
import NavProduct from "@/components/NavProduct.vue";
</script>

<style scoped></style>
