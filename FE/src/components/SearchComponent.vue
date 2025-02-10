<template>
  <!-- eslint-disable vue/no-v-model-argument -->
  <a-drawer
    v-model:open="open"
    root-class-name="root-class-name"
    placement="top"
    :closable="false"
    :maskClosable="false"
    class="justify-center flex min-h-[440px]"
  >
    <a-flex class="items-center flex-1 gap-[10px]">
      <a-flex
        class="flex-1 border-b border-[#ebebeb] focus-within:border-[#02b6ac]"
      >
        <a-input
          placeholder="Chúng tôi có thể giúp bạn tìm kiếm?"
          :bordered="false"
          class="px-0 py-[12px]"
          v-model:value="searchInput"
        >
          <template #suffix>
            <BxSearch
              class="cursor-pointer text-[24px] text-black hover:text-[#02b6ac]"
            />
          </template>
        </a-input>
      </a-flex>
      <ClCloseLg
        @click="closeSearch"
        class="cursor-pointer text-[20px] hover:text-[#02b6ac]"
      />
    </a-flex>
    <a-flex v-if="filteredData.length" vertical>
      <a-flex
        class="pt-[10px] pl-[5px]"
        v-for="item in filteredData"
        :key="item.id"
        vertical
      >
        <h5 class="text-[1.25rem] font-medium">{{ item.title }}</h5>
        <ul class="flex flex-col gap-[10px] py-[10px]">
          <li
            v-for="itemChil in item.item"
            :key="`${item.id}-${itemChil.id}`"
            class="text-black"
          >
            {{ itemChil.name }}
          </li>
        </ul>
      </a-flex>
    </a-flex>
  </a-drawer>
  <!-- eslint-disable vue/no-v-model-argument -->
</template>

<script setup>
import { ref, defineEmits, computed } from "vue";
import { ClCloseLg } from "@kalimahapps/vue-icons";
import { BxSearch } from "@kalimahapps/vue-icons";
import "./SearchComponent.css";
const emit = defineEmits(["closeSearch"]);

const open = ref(true);
const searchInput = ref("");

const filteredData = computed(() => {
  if (!searchInput.value.trim()) return data.value;
  return data.value
    .map((group) => ({
      ...group,
      item: group.item.filter((item) =>
        item.name.toLowerCase().includes(searchInput.value.toLowerCase())
      ),
    }))
    .filter((group) => group.item.length > 0);
});
const closeSearch = () => {
  open.value = false;
  setTimeout(() => {
    emit("closeSearch");
  }, 500);
};

const data = ref([
  {
    id: 1,
    title: "Tìm kiếm nhanh",
    item: [
      { id: 1, name: "Máy lọc nước Livotec 630" },
      { id: 2, name: "Máy lọc nước Livotec 638" },
      { id: 3, name: "Bếp từ đôi LID-888" },
      { id: 4, name: "Bình nước nóng LWH-ID30" },
    ],
  },
  {
    id: 2,
    title: "Từ khóa tìm kiếm nhiều",
    item: [
      { id: 1, name: "Bếp từ đôi" },
      { id: 2, name: "Máy lọc nước Livotec 216" },
      { id: 3, name: "Máy lọc nước Livotec 616" },
      { id: 4, name: "Bình nước nóng" },
    ],
  },
  {
    id: 3,
    title: "Từ khóa tìm kiếm nhiều",
    item: [
      { id: 1, name: "Bếp từ đôi" },
      { id: 2, name: "Máy lọc nước Livotec 216" },
      { id: 3, name: "Máy lọc nước Livotec 616" },
      { id: 4, name: "Bình nước nóng" },
    ],
  },
]);
</script>

<style></style>
