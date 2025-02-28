<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <div class="">
    <a-flex
      class="justify-center bg-[#02B6AC] sticky top-0 z-50 border-b-[1px] border-white"
    >
      <HeaderComponent />
    </a-flex>
    <main class="flex flex-col flex-1 gap-[100px] items-center mb-[50px]">
      <slot></slot>
    </main>
    <div
      class="fixed top-[80%] right-[2%] bg-[red] z-[90] p-2 rounded-lg border-[1px] border-gray-600"
    >
      <button class="text-[30px] text-white" @click="hanldeOpenChatBot">
        ChatBot
      </button>
    </div>
    <a-modal v-model:open="openChat" @ok="handleOk" class="modal">
      <ChatBotComponent />
    </a-modal>
    <a-flex class="justify-center bg-[#EAEBF4] bottom-0">
      <FooterComponent />
    </a-flex>
  </div>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import ChatBotComponent from "@/components/chatBot/ChatBotComponent.vue";
import FooterComponent from "@/components/home/FooterComponent.vue";
import HeaderComponent from "@/components/home/HeaderComponent.vue";
import { ref } from "vue";

const openChat = ref(false);
const hanldeOpenChatBot = () => {
  openChat.value = true;
};
const handleOk = () => {
  openChat.value = false;
};
</script>

<style>
.container,
.container-fluid,
.container-lg,
.container-md,
.container-sm,
.container-xl,
.container-xxl {
  --bs-gutter-x: 1.5rem;
  --bs-gutter-y: 0;
  width: 100%;
  padding-right: calc(var(--bs-gutter-x) * 0.5);
  padding-left: calc(var(--bs-gutter-x) * 0.5);
  margin-right: auto;
  margin-left: auto;
}

@media (min-width: 576px) {
  .container,
  .container-sm {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .container,
  .container-md,
  .container-sm {
    max-width: 720px;
  }
}

@media (min-width: 992px) {
  .container,
  .container-lg,
  .container-md,
  .container-sm {
    max-width: 960px;
  }
}

@media (min-width: 1200px) {
  .container,
  .container-lg,
  .container-md,
  .container-sm,
  .container-xl {
    max-width: 1140px;
  }
}

@media (min-width: 1400px) {
  .container,
  .container-lg,
  .container-md,
  .container-sm,
  .container-xl,
  .container-xxl {
    max-width: 1320px;
  }
}

.modal {
  top: 50px;
}
</style>
