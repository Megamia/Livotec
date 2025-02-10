<script setup>
import { RouterView } from "vue-router";
import { onMounted, onUnmounted } from "vue";

let timeoutId;

onMounted(() => {
  const tokenTimestamp = localStorage.getItem("tokenTimestamp");
  const currentTime = Date.now();

  if (tokenTimestamp && currentTime - tokenTimestamp >= 100000) {
    localStorage.removeItem("token");
    localStorage.removeItem("tokenTimestamp");
  } else {
    timeoutId = setTimeout(() => {
      localStorage.removeItem("token");
      localStorage.removeItem("tokenTimestamp");
    }, 100000 - (currentTime - tokenTimestamp || 0));
  }

  if (!tokenTimestamp) {
    localStorage.setItem("tokenTimestamp", Date.now());
  }
});

onUnmounted(() => {
  clearTimeout(timeoutId);
});
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
