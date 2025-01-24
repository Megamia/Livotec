<template>
  <DefaultLayout>
    <section v-if="product" class="w-full container">
      <main :key="product.id">
        <div class="py-2 border-b-2">
          <a-breadcrumb>
            <template #separator><span>></span></template>
            <a-breadcrumb-item
              ><a href="/" class="text-[15px] font-semibold"
                >Trang chủ</a
              ></a-breadcrumb-item
            >
            <a-breadcrumb-item
              ><a
                :href="`/${product.category.slug}`"
                class="text-[15px] font-semibold"
                >{{ product.category.name }}</a
              ></a-breadcrumb-item
            >
            <a-breadcrumb-item
              ><span class="text-[15px] font-semibold text-[#02B6AC]">{{
                product.name
              }}</span></a-breadcrumb-item
            >
          </a-breadcrumb>
        </div>
        <div class="w-full flex flex-wrap gap-2 max-lg:flex-col">
          <div class="flex-1 flex flex-col">
            <div class="flex-1 flex flex-col my-3 border rounded-md">
              <a-image-preview-group>
                <div class="w-full">
                  <a-image :src="activeImage" alt="Product Image" />
                </div>
                <div class="flex-wrap flex justify-evenly">
                  <a-image
                    v-for="item in product.gallery"
                    :key="item.id"
                    :src="item.path"
                    :width="120"
                    @click="setActiveImage(item.path)"
                    alt="Product Image"
                    :class="{
                      'gallery-image ring-2 ring-[#38B6AC] scale-100 rounded-sm my-2':
                        item.path === activeImage,
                      'gallery-image rounded-sm border my-2':
                        item.path !== activeImage,
                    }"
                  />
                </div>
              </a-image-preview-group>
            </div>
            <div class="flex flex-1 justify-evenly items-center">
              <div class="flex flex-col justify-center items-center gap-2">
                <img src="../assets/freeship.svg" />
                <span class="font-medium text-sm"
                  >Miễn phí vận chuyển toàn quốc</span
                >
              </div>
              <div class="flex flex-col justify-center items-center gap-2">
                <img src="../assets/setup.svg" />
                <span class="font-medium text-sm"
                  >Miễn phí lắp đặt toàn quốc</span
                >
              </div>
            </div>
          </div>
          <div class="flex-1 max-lg:w-full p-2 flex gap-2 flex-col">
            <h1 class="text-[#38B6AC] max-md:text-center text-[30px] font-bold">
              {{ product.name }}
            </h1>
            <a-rate
              :value="5"
              class="text-[25px] max-lg:text-center text-[#38B6AC]"
            />
            <div class="flex items-center gap-3 max-lg:justify-center">
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
              <!-- <div
                class="flex-1 bg-[#38B6AC] py-2 flex justify-center items-center rounded-md hover:opacity-80 cursor-pointer"
              >
                <span class="text-white text-[15px] font-medium">So Sánh</span>
              </div> -->
              <div
                class="flex-1 bg-[#38B6AC] py-2 flex justify-center items-center rounded-md hover:opacity-80 cursor-pointer"
                @click="addToComparison(product)"
              >
                <span class="text-white text-[15px] font-medium">So Sánh</span>
              </div>
              <div v-if="comparisonList.length === 1">coll</div>
            </div>
          </div>
        </div>
        <div class="my-4">
          <a-tabs v-model:activeKey="activeKey" size="large">
            <a-tab-pane key="1" tab="Đặc điểm nổi bật"
              ><ProductPosts v-if="product.post != null" :items="product.post"
            /></a-tab-pane>
            <a-tab-pane key="2" tab="Thông số sản phẩm" force-render
              ><ProductSpecifications
                v-if="product.thongso != null"
                :items="product.thongso"
            /></a-tab-pane>
            <a-tab-pane key="3" tab="Đánh giá"
              >Content of Tab Pane 3</a-tab-pane
            >
          </a-tabs>
        </div>
      </main>
    </section>
    <div v-else>Không có sản phẩm</div>
  </DefaultLayout>
</template>

<script setup>
import { onMounted, ref, inject } from "vue";
import { useRoute } from "vue-router";
import DefaultLayout from "./DefaultLayout.vue";
import axios from "axios";
import ProductSpecifications from "@/components/ProductSpecifications.vue";
import ProductPosts from "@/components/ProductPosts.vue";

const route = useRoute();
const product = ref(null);
const formattedPrice = ref(null);
const activeImage = ref(null);
const activeKey = ref("1");

onMounted(async () => {
  try {
    const { slug } = route.params;
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/product/${slug}`
    );
    product.value = response.data;
    formattedPrice.value = new Intl.NumberFormat("de-DE").format(
      product.value.price
    );
    if (product.value.gallery[0] != null) {
      activeImage.value = product.value.gallery[0].path;
    }
  } catch (error) {
    console.error("Error fetching product:", error);
  }
});

const setActiveImage = (path) => {
  activeImage.value = path;
};

const comparisonList = inject("comparisonList", []);

const addToComparison = (product) => {
  if (!comparisonList.includes(product)) {
    comparisonList.push(product);
    console.log(comparisonList);
    
  }
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
