<script setup>
import { RouterView } from "vue-router";
</script>

<template>
  <a-config-provider
    :theme="{
      token: {
        colorPrimary: '#02B6AC',
      },
    }"
  >
    <RouterView />
  </a-config-provider>
</template>

<style scoped></style>
