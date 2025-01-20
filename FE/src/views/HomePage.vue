<template>
  <a-flex class="flex-1 flex-col">
    <DefaultLayout>
      <HomeHeroSlideComponent />
      <a-flex>abs</a-flex>
    </DefaultLayout>
  </a-flex>
</template>

<script setup>
import HomeHeroSlideComponent from "@/components/HomeHeroSlideComponent.vue";
import DefaultLayout from "./DefaultLayout.vue";
</script>

<style scoped></style>
