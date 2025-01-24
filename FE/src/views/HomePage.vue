<template>
  <a-flex class="flex-1 flex-col">
    <DefaultLayout>
      <HomeHeroSlideComponent />
      <NavProductComponent/>
    </DefaultLayout>
  </a-flex>
</template>

<script setup>
import HomeHeroSlideComponent from "@/components/HomeHeroSlideComponent.vue";
import DefaultLayout from "./DefaultLayout.vue";
import NavProductComponent from "@/components/NavProductComponent.vue";
</script>

<style scoped></style>
