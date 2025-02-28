<template>
    <HomeHeroSlideComponent />
    <NavProductComponent />
    <ProductComponent :categorySlug="'may-loc-nuoc'" />
    <ProductComponent :categorySlug="'bep-tu'" />
</template>

<script setup>
import HomeHeroSlideComponent from "@/components/HomeHeroSlideComponent.vue";
import NavProductComponent from "@/components/NavProductComponent.vue";
import ProductComponent from "@/components/ProductComponent.vue";
</script>

<style scoped></style>
