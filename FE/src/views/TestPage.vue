<template>
  <DefaultLayoutGuarantee>
    <a-flex>
      <a-flex vertical class="p-[30px] gap-[10px]">
        <a-flex vertical>
          <a-flex>
            {{ post.title }}
          </a-flex>
          <a-flex gap="10">
            <a-flex>Tác giả: {{ post.user?.first_name }}</a-flex>
            <a-flex gap="5"
              >Chuyên mục:<span v-for="item in post.categories" :key="item.id"
                >{{ item.name }},</span
              ></a-flex
            >
            <a-flex>Ngày đăng: {{ post.published_at }}</a-flex>
          </a-flex>
        </a-flex>
        <div v-html="post.content_html" class="a"></div>
      </a-flex>
      <a-flex class="w-[600px] h-[100vh]">
        <img
          src="https://livotec.com/wp-content/uploads/2024/05/Bao-hanh_livotec-Mobile.jpg.webp"
        />
      </a-flex>
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
      }/post/bep-tu-giai-phap-nau-nuong-hien-dai-cho-can-bep-gia-dinh`
    );
    post.value = response.data;
    console.log(post.value);
  } catch (e) {
    console.log(e);
  }
};
</script>

<style scoped>
.a::v-deep(a) {
}
</style>
