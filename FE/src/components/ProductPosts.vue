<template>
  <div v-html="items.summary" class="post"></div>
</template>

<script setup>
defineProps({
  items: {
    required: true, // Đảm bảo props `items` được truyền vào
  },
});
</script>

<style>
.post ul {
  list-style: none; /* Loại bỏ bullet mặc định */
  padding: 0; /* Đảm bảo không có padding thừa */
}

.post ul li {
  position: relative;
  padding-left: 1.5em; /* Tạo khoảng cách cho dấu bullet */
  margin-top: 10px;
}

.post ul li::before {
  content: "•"; /* Dấu bullet tùy chỉnh */
  color: #38b6ac; /* Màu của dấu bullet */
  font-size: 1.5em; /* Kích thước dấu bullet */
  position: absolute; /* Định vị dấu bullet */
  left: 0; /* Căn dấu bullet vào lề trái */
  top: -5px; /* Đảm bảo dấu bullet nằm trên cùng của dòng */
}
</style>
