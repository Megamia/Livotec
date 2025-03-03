<template>
  <div>
    <a-flex
      class="justify-center bg-[#02B6AC] sticky top-0 z-50 border-b-[1px] border-white"
    >
      <HeaderComponent />
    </a-flex>
    <main class="flex flex-col flex-1 items-center mb-[50px] container p-0">
      <slot></slot>
    </main>
    <a-flex class="justify-center bg-[#EAEBF4] bottom-0">
      <FooterComponent />
    </a-flex>
  </div>
</template>

<script setup>
import FooterComponent from "@/components/guarantee/FooterComponent.vue";
import HeaderComponent from "@/components/guarantee/HeaderComponent.vue";
</script>

<style>
.container {
  --bs-gutter-x: 1.5rem !important;
  --bs-gutter-y: 0 !important;
  width: 100% !important;
  padding-right: calc(var(--bs-gutter-x) * 0.5) !important;
  padding-left: calc(var(--bs-gutter-x) * 0.5) !important;
  margin-right: auto !important;
  margin-left: auto !important;
}

@media (min-width: 576px) {
  .container { max-width: 540px !important; }
}

@media (min-width: 768px) {
  .container { max-width: 720px !important; }
}

@media (min-width: 992px) {
  .container { max-width: 960px !important; }
}

@media (min-width: 1200px) {
  .container { max-width: 1140px !important; }
}

@media (min-width: 1400px) {
  .container { max-width: 1320px !important; }
}

</style>
