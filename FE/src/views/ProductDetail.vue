<template>
  <DefaultLayout>
    <section v-if="product" class="w-full container">
      <main :key="product.id">
        <div class="w-full flex flex-wrap gap-2 max-md:flex-col">
          <div class="flex-1 flex px-2 flex-col m-3 border rounded-md">
            <a-image-preview-group>
              <div class="w-full">
                <a-image :src="activeImage" alt="Product Image" />
              </div>
              <div class="flex justify-evenly gap-2 w-full">
                <a-image
                  v-for="item in product.gallery"
                  :key="item.id"
                  :src="item.path"
                  @click="setActiveImage(item.path)"
                  alt="Product Image"
                  :class="{
                    'gallery-image ring-2 ring-[#38B6AC] scale-100 rounded-sm':
                      item.path === activeImage,
                    'gallery-image': item.path !== activeImage,
                  }"
                />
              </div>
            </a-image-preview-group>
          </div>
          <div class="flex-1 max-md:w-full p-2 flex gap-2 flex-col">
            <h1 class="text-[#38B6AC] max-md:text-center text-[30px] font-bold">
              {{ product.name }}
            </h1>
            <a-rate :value="5" class="text-[25px] max-md:text-center text-[#38B6AC]" />
            <div class="flex items-center gap-3 max-md:justify-center">
              <span> Chia sẻ mạng sản phẩm: </span>
              <div class="w-8 h-8 bg-blue-300"></div>
              <div class="w-8 h-8 bg-blue-300"></div>
              <div class="w-8 h-8 bg-blue-300"></div>
            </div>
            <div class="border-spacing-1 border-gray-400 border mx-10"></div>
            <div v-html="product.description" class="description"></div>
            <div
              class="text-[#EF0B00] font-bold text-[45px] flex gap-2 items-center w-full justify-center my-5"
            >
              {{ formattedPrice }}
              <span class="font-bold text-[35px] mb-1">₫</span>
            </div>
            <div class="flex flex-wrap gap-2">
              <div
                class="w-full bg-[#38B6AC] py-2 flex justify-center items-center gap-2 rounded-md hover:opacity-80 cursor-pointer"
              >
                <span class="text-[#FFF833] font-bold text-[18px]"
                  >Gọi Đặt Mua: 1800 2298</span
                >
                <span class="text-white text-[15px] font-medium"
                  >( 7:30 - 21:00 )</span
                >
              </div>
              <div
                class="flex-1 bg-[#EF0B00] py-2 flex justify-center items-center rounded-md hover:opacity-80 cursor-pointer"
              >
                <span class="text-white text-[15px] font-medium">Mua Ngay</span>
              </div>
              <div
                class="flex-1 bg-[#38B6AC] py-2 flex justify-center items-center rounded-md hover:opacity-80 cursor-pointer"
              >
                <span class="text-white text-[15px] font-medium">So Sánh</span>
              </div>
            </div>
          </div>
          <div></div>
        </div>
      </main>
    </section>
    <div v-else>Không có sản phẩm</div>
  </DefaultLayout>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import DefaultLayout from "./DefaultLayout.vue";
import axios from "axios";

const route = useRoute();
const product = ref(null);
const formattedPrice = ref(null);
const activeImage = ref(null);

onMounted(async () => {
  try {
    const { slug } = route.params;
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/products/${slug}`
    );
    product.value = response.data;
    formattedPrice.value = new Intl.NumberFormat("de-DE").format(
      product.value.price
    );
    activeImage.value = product.value.gallery[0].path;
  } catch (error) {
    console.error("Error fetching product:", error);
  }
});

const setActiveImage = (path) => {
  activeImage.value = path;
};
</script>

<style>
.description ul {
  list-style: none; /* Loại bỏ bullet mặc định */
  padding: 0; /* Đảm bảo không có padding thừa */
}

.description ul li {
  position: relative;
  padding-left: 1.5em; /* Tạo khoảng cách cho dấu bullet */
  margin-top: 10px;
}

.description ul li::before {
  content: "•"; /* Dấu bullet tùy chỉnh */
  color: #38b6ac; /* Màu của dấu bullet */
  font-size: 1.5em; /* Kích thước dấu bullet */
  position: absolute; /* Định vị dấu bullet */
  left: 0; /* Căn dấu bullet vào lề trái */
  top: -5px; /* Đảm bảo dấu bullet nằm trên cùng của dòng */
}

.gallery-image {
  width: 100px; /* Chiều rộng cố định */
  height: 100px; /* Chiều cao cố định */
  object-fit: cover; /* Đảm bảo ảnh vừa với khung mà không bị biến dạng */
  border-radius: 4px; /* Bo tròn góc (tuỳ chọn) */
}


</style>
