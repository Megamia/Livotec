<template>
  <DefaultLayoutGuarantee>
    <a-flex vertical class="h-[1000px]">
      <a-flex vertical>
        <a-flex>
          {{ post.title }}
        </a-flex>
        <a-flex gap="10">
          <a-flex>Tác giả: {{ post.user?.first_name }}</a-flex>
          <a-flex gap="5">Chuyên mục:<span v-for="item in post.categories" :key="item.id">{{ item.name }},</span></a-flex>
          <a-flex>Ngày đăng: {{ post.published_at }}</a-flex>
        </a-flex>
      </a-flex>
      <div v-html="post.summary"></div>
    </a-flex>
  </DefaultLayoutGuarantee>
</template>

<script setup>
import { onMounted, ref } from "vue";
import DefaultLayoutGuarantee from "../views/DefaultLayoutGuarantee.vue";
import axios from "axios";

const post = ref("");

onMounted(() => {
  fetchData();
});
const fetchData = async () => {
  try {
    const response = await axios.get(
      `${
        import.meta.env.VITE_APP_URL_API_POST
      }/post/bep-tu-don-livotec-e-smart-tiet-kiem-thoi-gian-va-dien-nang`
    );
    post.value = response.data;
    console.log(post.value);
  } catch (e) {
    console.log(e);
  }
};
</script>
