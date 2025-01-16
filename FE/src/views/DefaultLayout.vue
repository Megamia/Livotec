<template>
  <div>
    <a-flex class="justify-center bg-[#02B6AC] sticky top-0">
      <HeaderComponent />
    </a-flex>
    <main>
      <slot></slot>
    </main>
    <a-flex class="justify-center bg-[#EAEBF4] bottom-0">
      <FooterComponent />
    </a-flex>
  </div>
</template>

<script setup>
import FooterComponent from "@/components/FooterComponent.vue";
import HeaderComponent from "@/components/HeaderComponent.vue";
</script>

<style scoped></style>
