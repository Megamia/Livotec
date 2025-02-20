<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <a-flex vertical class="w-full justify-center items-center gap-[50px]">
    <a-flex class="flex-1 flex-wrap gap-[20px]">
      <a-flex
        v-for="item in data"
        :key="item.id"
        class="w-[100%] max-w-[400px]"
      >
        <a-flex vertical class="w-full px-[10px]">
          <img
            :src="item.image_url || defaultImage"
            class="w-[100%] h-[270px] object-cover"
          />
          <a-flex vertical class="w-[100%] p-[15px] gap-[10px] bg-[#ededed]">
            <a-flex class="text-[#6d6d6d] items-center gap-[3px]">
              <AkClock /> {{ formatDate(item.published_at) }}
            </a-flex>

            <span
              class="contentHtmlSpan2Text text-black font-normal leading-[23px] min-h-[50px]"
            >
              {{ item.title }}
            </span>
            <span
              class="contentHtmlSpan3Text text-[16px] text-black font-normal"
            >
              {{ truncateText(item.content_html) }}
            </span>
            <a
              :href="`/detailNews/${item.slug}`"
              class="text-[#0d6efd] hover:bg-[#ededed] hover:text-[#02B6AC]"
            >
              Đọc tiếp</a
            >
          </a-flex>
        </a-flex>
      </a-flex>
    </a-flex>
  </a-flex>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import axios from "axios";
import dayjs from "dayjs";
import { onMounted, ref } from "vue";
import { AkClock } from "@kalimahapps/vue-icons";


const data = ref([]);

const fetchData = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_POST}/allPost`
    );
    // data.value = response.data;
    console.log(response.data);
  } catch (e) {
    console.log("Error: ", e);
  }
};

onMounted(() => fetchData());
const truncateText = (htmlContent) => {
  if (!htmlContent) return "";

  const tempElement = document.createElement("div");
  tempElement.innerHTML = htmlContent;
  tempElement.querySelectorAll("img").forEach((img) => img.remove());

  return tempElement.textContent.trim().split("\n")[0];
};

const formatDate = (date) => {
  return date ? dayjs(date).format("DD/MM/YYYY") : "";
};
</script>

<style scoped></style>
