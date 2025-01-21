<template>
  <a-flex vertical align="center">
    <h1 class="text-[24px] font-semibold text-[#02b6ac]">
      Livotec-Công nghệ thông minh, sống khỏe mỗi ngày
    </h1>

    <a-tabs
      v-model:activeKey="activeKey"
      class="a"
      @change="changeData"
      tabBarStyle=" display:flex;flex:1; justify-content:center; "
    >
      <a-tab-pane
        v-for="item in data"
        :key="item.id"
        :tab="item.name"
        class="flex gap-[10px]"
      >
        <a-flex v-for="itemChil in item.data" :key="itemChil.id">
          <a-flex>
            <a-flex vertical>
              {{ itemChil.id }}
              {{ itemChil.name }}
              {{ itemChil.price }}
              <div v-html="itemChil.description" class="test"></div>

              <!-- {{ itemChil.slug }} -->
            </a-flex>
          </a-flex>
        </a-flex>
      </a-tab-pane>
    </a-tabs>
  </a-flex>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";

const activeKey = ref(1);
const changeData = async (id) => {
  await fetchData(id);
};
const data = ref([
  { id: 1, name: "Bếp từ", data: null },
  { id: 2, name: "Máy lọc nước", data: null },
  { id: 3, name: "Bình nước nóng", data: null },
  { id: 4, name: "Linh kiện, Lõi lọc", data: null },
]);

const fetchData = async (id) => {
  if (id === undefined) {
    id = 1;
  }
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/products/${id}`
    );
    if (response.data.length > 0) {
      const item = data.value.find((item) => item.id === id);
      item.data = response.data;
      if (item) {
        // for (let i = 0; i < response.data.length; i++) {
        //   item.data = response.data[i];
        // }
        console.log(item.data);
      }
    } else {
      console.log("No data");
    }
  } catch (e) {
    console.log("Error: ", e);
  }
};
onMounted(() => fetchData());
</script>

<style>
.a::v-deep(.ant-tabs-tab) {
  margin: 0;
  padding-inline: 0.5rem;
}

.a::v-deep(.ant-tabs-nav .ant-tabs-tab-btn) {
  font-size: 18px;
  font-weight: 500;
}

.test ul li::before {
  content: "•";
  margin-right: 0.5rem;
  color: black;
  position: absolute;
  left: 0;
  top: 0;
}
.test ul li {
  position: relative;
  padding-left: 10px;
}
</style>
