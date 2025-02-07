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
        <a-flex></a-flex>
        <a-flex class="mb-4">
          <section>
            <a-flex wrap="wrap" gap="small">
              <a-badge count="1" :offset="[-15, 0]">
                <a-flex class="gap-1 items-center sort_item"
                  ><PhLightFunnel class="text-[18px] font-medium" /><span
                    class="text-[14px]"
                    >Bộ lọc</span
                  ></a-flex
                > </a-badge
              ><a-flex
                v-for="item in new Array(4)"
                :key="item"
                type="primary"
                class="gap-1 items-center sort_item"
                >Button<AkChevronDownSmall /></a-flex
              ><a-flex type="primary" class="gap-2 items-center sort_item"
                ><CdTag class="text-[17px]"/>Giá</a-flex
              ></a-flex
            >
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
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const category = ref("");

onMounted(async () => {
  try {
    const { slug } = route.params;
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_CATEGORY}/category/${slug}`
    );
    category.value = response.data;
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
}
</style>
