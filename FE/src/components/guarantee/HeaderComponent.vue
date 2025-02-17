<template>
  <a-flex class="flex-1 relative justify-between p-[20px] gap-[30px] a">
    <a-flex>
      <router-link to="/">
        <img
          src="https://livotec.com/wp-content/uploads/2024/08/logo-livotec.png"
          class="w-[126px] min-w-[126px]"
        />
      </router-link>
    </a-flex>

    <a-flex class="flex-1 justify-center gap-[100px]">
      <span
        :class="{
          'active-liText': liActive === '1',
        }"
        class="liText"
        @click="changeLiActive('1')"
      >
        Trang chủ
      </span>
      <span
        :class="{
          'active-liText': liActive === '2',
        }"
        class="liText"
        @click="changeLiActive('2')"
      >
        Kích hoạt bảo hành
      </span>
      <span
        :class="{
          'active-liText': liActive === '3',
        }"
        class="liText"
        @click="changeLiActive('3')"
      >
        Đăng ký bảo hành tận nhà
      </span>
    </a-flex>
  </a-flex>
</template>

<script setup>
import { ref } from "vue";
import "./header.css";

const liActive = ref("1");

const changeLiActive = (value) => {
  liActive.value = value;
};
</script>

<style scoped>
.liText {
  color: white;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  padding-inline: 19px;
  padding-block: 3px;
  border-radius: 3px;
  text-align: center;
  transition: all 0.3s ease-in-out;
}

.liText:hover {
  background-color: white;
  color: #01b6ac;
  border-radius: 15px;
}

.active-liText {
  background-color: white !important;
  color: #01b6ac !important;
  border-radius: 15px !important;
}
</style>
