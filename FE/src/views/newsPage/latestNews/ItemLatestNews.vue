<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <a-flex vertical class="w-full justify-center items-center gap-[50px]">
    <a-flex class="flex-1 flex-wrap gap-[20px]">
      <a-flex
        v-for="item in paginatedData"
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

    <a-pagination
      v-model:current="currentPage"
      :total="data.length"
      :page-size="pageSize"
      @change="onPageChange"
      show-less-items
    />
  </a-flex>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>
<script setup>
import axios from "axios";
import dayjs from "dayjs";
import { ref, computed, onMounted } from "vue";
import { AkClock } from "@kalimahapps/vue-icons";

const props = defineProps({
  categories: String,
});

const data = ref([]);
const currentPage = ref(1);
const pageSize = 6;
const defaultImage =
  "https://livotec.com/wp-content/uploads/2024/11/Binh-tam-nong-lanh-%E2%80%93-Giai-phap-hoan-hao-cho-ngoi-nha-hien-dai.jpg";

const fetchData = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_POST}/hotNews/${props.categories}`
    );
    data.value = response.data;
  } catch (e) {
    console.log(e);
  }
};

const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * pageSize;
  const end = start + pageSize;
  return data.value.slice(start, end);
});

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

const onPageChange = (page) => {
  currentPage.value = page;
};

onMounted(() => {
  fetchData();
});
</script>
<style scoped>
.contentHtmlSpan2Text {
  font-size: calc(1.275rem + 0.3vw);
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  max-width: 100%; 
}

.contentHtmlSpan3Text {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  max-width: 100%;
}
</style>
