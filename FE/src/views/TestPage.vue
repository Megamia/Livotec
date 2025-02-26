<template>
  <div class="p-5">
    <h1 class="text-2xl font-bold text-center mb-6">Chatbot Học & Ứng Dụng</h1>

    <div class="mb-8 p-5 border border-gray-400 rounded-lg">
      <h2 class="text-xl font-bold mb-4 text-blue-600">Dạy Chatbot</h2>
      <div class="flex gap-4 mb-4">
        <input
          v-model="teachQuestion"
          placeholder="Nhập câu hỏi"
          class="border p-2 w-full"
        />
        <input
          v-model="teachAnswer"
          placeholder="Nhập câu trả lời"
          class="border p-2 w-full"
        />
        <button @click="teachChatbot" class="bg-blue-500 text-white px-4 py-2">
          Gửi
        </button>
      </div>
      <p v-if="teachMessage" class="text-green-600">{{ teachMessage }}</p>
      <p v-else class="text-red-600">{{ messageError }}</p>
    </div>

    <div class="p-5 border border-gray-400 rounded-lg">
      <h2 class="text-xl font-bold mb-4 text-green-600">Hỏi Chatbot</h2>
      <div class="flex gap-4 mb-4">
        <input
          v-model="chatQuestion"
          placeholder="Nhập câu hỏi"
          class="border p-2 w-full"
          @keyup.enter="askChatbot"
        />
        <button @click="askChatbot" class="bg-green-500 text-white px-4 py-2">
          Hỏi
        </button>
      </div>

      <div
        v-if="chatHistory.length"
        class="mt-4 p-4 border rounded-lg bg-gray-100 max-h-80 overflow-y-auto flex flex-col-reverse"
      >
        <ul>
          <li v-for="(chat, index) in chatHistory" :key="index" class="">
            <p v-if="chat.answer !== null" class="text-purple-600">
              <strong>Chatbot:</strong> {{ chat.answer }}
            </p>
            <p class="text-blue-600 text-end">
              <strong>Bạn:</strong> {{ chat.question }}
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const teachQuestion = ref("");
const teachAnswer = ref("");
const teachMessage = ref("");
const messageError = ref("");

const chatQuestion = ref("");
const chatHistory = ref([]);

const teachChatbot = async () => {
  if (!teachQuestion.value.trim() || !teachAnswer.value.trim()) {
    messageError.value = "Vui lòng nhập cả câu hỏi và câu trả lời!";
    return;
  }

  try {
    const message = `${teachQuestion.value} | ${teachAnswer.value}`;
    const response = await axios.post(
      `${import.meta.env.VITE_APP_URL_API_CHATBOT}/learn`,
      { message }
    );

    if (
      response.data.status === 1 &&
      response.data.message === "Tạo dữ liệu mới"
    ) {
      teachMessage.value = response.data.reply;
      teachQuestion.value = "";
      teachAnswer.value = "";
    } else if (
      response.data.status === 0 &&
      response.data.message === "Đã tồn tại"
    ) {
      teachMessage.value = "";
      messageError.value = response.data.reply;
    } else {
      alert("Phản hồi không hợp lệ từ API.");
    }
  } catch (error) {
    console.error("Lỗi khi dạy chatbot:", error);
    messageError.value =
      error.response?.data?.reply || "Đã xảy ra lỗi khi dạy chatbot!";
  }
};

const askChatbot = async () => {
  if (!chatQuestion.value.trim()) {
    alert("Vui lòng nhập câu hỏi!");
    return;
  }

  const chatEntry = { question: chatQuestion.value, answer: null };
  chatHistory.value.unshift(chatEntry);

  const userQuestion = chatQuestion.value;
  chatQuestion.value = "";

  try {
    const response = await axios.post(
      `${import.meta.env.VITE_APP_URL_API_CHATBOT}/chat`,
      { message: userQuestion }
    );

    const reply = response.data.reply || "Không nhận được phản hồi từ chatbot.";

    setTimeout(() => {
      chatEntry.answer = reply;
      chatHistory.value = [...chatHistory.value];
    }, 2000);
  } catch (error) {
    console.error("Lỗi khi hỏi chatbot:", error);
    alert(error.response?.data?.reply || "Đã xảy ra lỗi khi hỏi chatbot!");
  }
};
</script>
