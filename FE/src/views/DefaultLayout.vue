<template>
  <div>
    <a-flex
      class="justify-center bg-[#02B6AC] sticky top-0 z-50 border-b-[1px] border-white"
    >
      <HeaderComponent />
    </a-flex>
    <main class="flex flex-col flex-1 gap-[100px]">
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
