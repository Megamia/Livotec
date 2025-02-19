<template>
  <DefaultLayout>
    <a-flex class="w-[100%] px-[20px] py-[15px] gap-[30px] a">
      <a-flex vertical class="flex-1 gap-[15px]">
        <a-flex class="fledx-1 border-b-[1px] pb-[15px] border-[#dbe0f0]">
          <span class="text-[18px] text-[#38b6ac] font-medium">Tin tức</span>
        </a-flex>
        <a-flex class="justify-center">
          <h1 class="text-[28px] font-bold text-[#38b6ac]">Tin nổi bật</h1>
        </a-flex>
      </a-flex>
    </a-flex>
  </DefaultLayout>
</template>

<script setup>
import { onMounted } from "vue";
import DefaultLayout from "../DefaultLayout.vue";
import "./news.css";
import axios from "axios";

// onMounted(() => {
//   fetchData();
// });
// const fetchData = async () => {
//   try {
//     const response = await axios.get(
//       `${import.meta.env.VITE_APP_URL_API_POST}/hotNews/${}`
//     );
//     const sortedPosts = response.data.sort(
//       (a, b) => new Date(a.published_at) - new Date(b.published_at)
//     );
//     console.log(sortedPosts.slice(0, 3));
//   } catch (e) {
//     console.log(e);
//   }
// };
</script>

<style scoped></style>
