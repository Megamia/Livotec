<template>
  <a-flex vertical class="flex-1">
    <img
      src="https://example.sudospaces.com/baohanhlivotec/2024/06/bao-hanh-livotec-pc.jpg"
    />
    <a-flex vertical justify="center" class="flex-1">
      <h2 class="h2Text">Dịch vụ 5 sao, bảo hành tới 36 tháng</h2>
      <span class="text-[16px] font-normal text-black">
        Livotec là một thương hiệu điện gia dụng đa ngành, được thành lập với sứ
        mệnh giúp người Việt SỐNG KHỎE MỖI NGÀY. Với tầm nhìn dài hạn, Livotec
        đầu tư và phát triển để trở thành một thương hiệu điện gia dụng không
        chỉ đáp ứng nhu cầu của người dân Việt Nam mà còn vươn ra thị trường
        quốc tế.<br />
        Livotec định vị là thương hiệu cung cấp các sản phẩm chất lượng tốt mang
        đến sự chăm sóc sức khỏe và tiện lợi cho khách hàng trong phân khúc phổ
        thông và cao cấp hơn.<br />
        Bên cạnh CHẤT LƯỢNG VƯỢT TRỘI, các sản phẩm của Livotec còn chú trọng
        đến yếu tố AN TOÀN – BỀN BỈ, đồng thời giúp tiết kiệm chi phí, phù hợp
        với người tiêu dùng có thu nhập phổ thông và trên phổ thông.
      </span>
    </a-flex>
    <a-flex vertical class="flex-1 justify-center">
      <h2 class="h2Text">Sản phẩm nổi bật</h2>
      <ul class="flex flex-1 flex-row justify-center gap-[30px]">
        <li
          v-for="item in data"
          :key="item.id"
          class="text-black text-[22px] font-semibold whitespace-nowrap cursor-pointer liActive"
          :class="{
            liActived: liActive === item.id,
          }"
          @click="changeLiActive(item.id)"
        >
          {{ item.name }}
        </li>
      </ul>
      <a-flex justify="center" class="h-[100px] pb-[77px]"> data </a-flex>
      <a-flex justify="center">
        <button
          class="bg-[#01b6ac] text-white rounded-3xl w-[205px] py-[11px] text-[18px] font-semibold"
        >
          Nhận tư vấn
        </button>
      </a-flex>
    </a-flex>

    <a-flex> </a-flex>
  </a-flex>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";

onMounted(() => fetchData());

const liActive = ref(1);

const data = ref([]);
const fetchData = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_CATEGORY}/allCategory`
    );
    data.value = response.data.data1.slice(0, 4);
  } catch (e) {
    console.log("Error: ", e);
  }
};

const changeLiActive = (value) => {
  liActive.value = value;
};
</script>

<style scoped>
.h2Text {
  padding-top: 81px;
  padding-bottom: 47px;
  text-align: center;
  color: #01b6ac;
  font-size: 32px;
  font-weight: 600;
  text-transform: uppercase;
}
.liActived {
  text-decoration: underline solid;
  text-decoration-thickness: 2px;
  text-underline-offset: 3px;
  color: #01b6ac;
}
.liActive:hover {
  transition: all 0.3s ease-in-out;
  text-decoration: underline solid;
  text-decoration-thickness: 2px;
  text-underline-offset: 3px;
  color: #01b6ac;
}
</style>
