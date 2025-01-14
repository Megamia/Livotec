<template>
  <a-flex class="flex-1 flex-col h-[2000px]">
    <span>Home</span>
    <router-link to="/login">Login</router-link>
    <router-link to="/register">Register</router-link>
    <div class="flex flex-1">as</div>
    <div class="relative bottom-0 left-0">
      <FooterComponent />
    </div>
  </a-flex>
</template>

<script setup>
import FooterComponent from "../components/FooterComponent.vue";
</script>

<style scoped></style>
