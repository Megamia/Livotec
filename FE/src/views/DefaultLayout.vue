<template>
  <div>
    <a-flex class="justify-center bg-[#02B6AC]">
      <HeaderComponent />
    </a-flex>
    <main>
      <slot></slot>
    </main>
    <div class="relative bottom-0 left-0">
      <FooterComponent />
    </div>
  </div>
</template>

<script setup>
import FooterComponent from "@/components/FooterComponent.vue";
import HeaderComponent from "@/components/HeaderComponent.vue";
</script>

<style scoped></style>
