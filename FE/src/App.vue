<script setup>
import layouts from "./views/layouts";
import { RouterView, useRoute } from "vue-router";
import { computed, onMounted, onUnmounted } from "vue";

let timeoutId;
const route = useRoute();

const layout = computed(() => layouts[route.meta.layout] || layouts.default);

onMounted(() => {
  const tokenTimestamp = localStorage.getItem("tokenTimestamp");
  const currentTime = Date.now();

  if (tokenTimestamp && currentTime - tokenTimestamp >= 3600000) {
    localStorage.removeItem("token");
    localStorage.removeItem("tokenTimestamp");
  } else {
    timeoutId = setTimeout(() => {
      localStorage.removeItem("token");
      localStorage.removeItem("tokenTimestamp");
    }, 3600000 - (currentTime - tokenTimestamp || 0));
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
    <component :is="layout">
      <router-view />
    </component>
  </a-config-provider>
</template>

<style scoped></style>
