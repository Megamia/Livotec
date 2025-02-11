<template>
  <DefaultLayout>
    <section class="container w-full flex flex-col gap-[30px]">
      <CategorySlideComponent :path="category?.image?.path" />
      <a-flex vertical class="w-full">
        <a-flex
          class="mb-[1rem] border-t-[1px] border-b-[1px] border-[#dbe0f0] bg-[#f6f9ff] gap-[24px] w-full"
        >
          <a-flex class="p-[18px] px-[15px] border-b border-b-[#02b6ac]">
            <h1 class="text-[16px] font-bold text-[#02b6ac]">
              {{ category.name }}
            </h1>
          </a-flex>
        </a-flex>
        <a-form></a-form>
        <a-flex
          v-if="Object.keys(selectedFilter).length > 0"
          class="flex-wrap gap-2"
        >
          <a-flex
            v-for="(label, filterId) in selectedFilter"
            :key="filterId"
            class="p-1 px-3 bg-[#FDC400] rounded-md mb-[15px]"
          >
            <span class="font-normal">{{ label }}</span>
          </a-flex>
        </a-flex>
        <a-flex class="mb-4">
          <section>
            <a-flex wrap="wrap" gap="small">
              <a-badge
                :count="Object.keys(selectedFilter).length"
                :offset="[-15, 0]"
              >
                <a-flex class="gap-1 items-center sort_item"
                  ><PhLightFunnel class="text-[18px] font-medium" /><span
                    class="text-[14px]"
                    >Bộ lọc</span
                  ></a-flex
                >
              </a-badge>
              <div v-for="filter in category.filters" :key="filter.id">
                <a-dropdown :trigger="['click']" arrow>
                  <a
                    @click.prevent
                    type="primary"
                    class="gap-1 items-center sort_item flex"
                  >
                    {{ filter.name }}<AkChevronDownSmall />
                  </a>
                  <template #overlay>
                    <a-flex vertical class="gap-2 p-0">
                      <a-menu>
                        <a-flex class="flex-wrap gap-4">
                          <a-menu-item
                            v-for="item in filter.options"
                            :key="item.label"
                            @click="selectOption(filter.id, item.label)"
                            class="border"
                          >
                            {{ item.label }}
                          </a-menu-item>
                        </a-flex>
                      </a-menu>
                      <a-flex
                        class="w-full gap-3 py-2 px-6 bg-white z-10 justify-center"
                        ><a-button
                          class="text-red-500 border-red-500 px-8"
                          @click="clearOption(filter.id)"
                        >
                          <span class="font-bold">Bỏ chọn</span> </a-button
                        ><a-button class="text-white px-5 bg-[#02b6ac]">
                          <span class="font-bold">Xem kết quả</span>
                        </a-button></a-flex
                      >
                    </a-flex>
                  </template>
                </a-dropdown>
              </div>
              <a-dropdown :trigger="['click']" arrow>
                <a
                  @click.prevent
                  type="primary"
                  class="gap-2 items-center sort_item flex"
                >
                  <CdTag class="text-[17px]" />Giá
                </a>
                <template #overlay>
                  <a-menu>
                    <a-flex class="flex-wrap">
                      <a-menu-item key="0">
                        <a href="http://www.alipay.com/">1st menu item</a>
                      </a-menu-item>
                      <a-menu-item key="1">
                        <a href="http://www.taobao.com/">2nd menu item</a>
                      </a-menu-item>
                      <a-menu-divider />
                      <a-menu-item key="3">3rd menu item</a-menu-item>
                    </a-flex>
                  </a-menu>
                </template>
              </a-dropdown>
            </a-flex>
          </section>
        </a-flex>
      </a-flex>
    </section>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "./DefaultLayout.vue";
import CategorySlideComponent from "@/components/CategorySlideComponent.vue";
import {
  PhLightFunnel,
  AkChevronDownSmall,
  CdTag,
} from "@kalimahapps/vue-icons";

import axios from "axios";
import { ref, onMounted, reactive } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const category = ref("");
const selectedFilter = reactive({});
const productCurrentData = ref("");

const selectOption = (filterId, label) => {
  selectedFilter[filterId] = label;
  console.log(selectedFilter);
};

const clearOption = (filterId) => {
  delete selectedFilter[filterId]; // Xóa bộ lọc đã chọn
  console.log("Cleared:", selectedFilter);
};

onMounted(async () => {
  try {
    const { slug } = route.params;
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_CATEGORY}/category/${slug}`
    );
    category.value = response.data;
    productCurrentData.value = category.value.products;
  } catch (error) {
    console.error("Error fetching category:", error);
  }
});
</script>

<style scoped>
.sort_item {
  border-color: #e9e9e9;
  padding: 7px 16px;
  border-radius: 0.375rem /* 6px */;
  border-width: 1px;
}
.sort_item:hover {
  cursor: pointer;
  border-color: #02b6ac;
  color: #02b6ac;
  background: white;
}
</style>
