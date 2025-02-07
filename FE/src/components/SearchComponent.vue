<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <a-drawer
    v-model:open="open"
    root-class-name="root-class-name"
    placement="top"
    :closable="false"
    :maskClosable="false"
  >
    <template #title>
      <a-flex class="justify-between flex-1 items-center">
        <span class="text-[18px] font-bold">MENU</span>
        <ClCloseLg @click="closeSearch" class="cursor-pointer" />
      </a-flex>
    </template>
    <a-flex> Content </a-flex>
  </a-drawer>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import { ref, defineEmits } from "vue";
import { ClCloseLg } from "@kalimahapps/vue-icons";
const emit = defineEmits(["closeSearch"]);

const open = ref(true);

const closeSearch = () => {
  open.value = false;
  setTimeout(() => {
    emit("closeSearch");
  }, 500);
};
</script>

<style scoped></style>
