<template>
  <a-flex class="flex-1 flex-col">
    <DefaultLayoutGuarantee>
      <GuaranteePage />
    </DefaultLayoutGuarantee>
  </a-flex>
</template>

<script setup>
import DefaultLayoutGuarantee from "./DefaultLayoutGuarantee.vue";
import GuaranteePage from "./guarantee/GuaranteePage.vue";
</script>

<style scoped></style>
