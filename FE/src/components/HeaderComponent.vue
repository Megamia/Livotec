<template>
  <a-flex class="flex-1 justify-between p-[20px] gap-[30px] a">
    <a-flex>
      <router-link to="/">
        <img
          src="https://livotec.com/wp-content/uploads/2024/08/logo-livotec.png"
        />
      </router-link>
    </a-flex>
    <a-flex class="flex-1 hidden-mobie" vertical>
      <a-input placeholder="Chúng tôi có thể giúp bạn tìm kiếm?">
        <template #suffix>
          <BxSearch />
        </template>
      </a-input>
      <a-flex class="text-white flex-wrap gap-x-[8px]">
        <a-dropdown
          class="flex flex-row items-center gap-1 hover:text-white text-nowrap basis-1/7"
          v-for="item in data"
          :key="item.id"
        >
          <a class="ant-dropdown-link" @click.prevent>
            {{ item.name }}
            <AnFilledCaretDown v-if="item.itemChil" />
          </a>
          <template #overlay>
            <a-menu v-if="item.itemChil">
              <a-menu-item v-for="itemChil in item.itemChil" :key="itemChil.id">
                {{ itemChil.name }}
              </a-menu-item>
            </a-menu>
          </template>
        </a-dropdown>
      </a-flex>
    </a-flex>
    <a-flex class="items-center justify-end gap-4">
      <BxSearch class="icon iconHidden" @click="showSearch" />
      <SearchComponent v-if="isOpenSearch" @close-search="showSearch" />
      <a-badge
        count="5"
        :number-style="{
          backgroundColor: '#fff',
          color: 'black',
          boxShadow: '0 0 0 1px #d9d9d9 inset',
        }"
      >
        <BsCart2 class="icon iconShow" @click="showCart" />
      </a-badge>
      <AnOutlinedMenu class="icon iconHidden" @click="showMenu" />
      <MenuComponent v-if="isOpenMenu" @close-menu="showMenu" />
      <a-flex class="items-center">
        <AnOutlinedUser
          v-if="isLogin"
          @click="handleLogout"
          class="icon iconShow"
        />
        <RouterLink to="/login" class="text-white" v-else>
          Đăng nhập</RouterLink
        >
      </a-flex>
    </a-flex>
  </a-flex>
</template>

<script setup>
import MenuComponent from "./MenuComponent.vue";
import SearchComponent from "./SearchComponent.vue";
import { ref, onMounted } from "vue";
import "./header.css";
import {
  BxSearch,
  BsCart2,
  AnOutlinedMenu,
  AnOutlinedUser,
  AnFilledCaretDown,
} from "@kalimahapps/vue-icons";

const isLogin = ref(false);

const handleLogout = () => {
  if (confirm("Chắc chắn muốn đăng xuất?")) {
    isLogin.value = false;
  } else {
    return;
  }
};

const fetchData = () => {
  const token = localStorage.getItem("token");
  if (token) {
    isLogin.value = true;
  } else {
    isLogin.value = false;
  }
};
onMounted(() => fetchData());

const isOpenMenu = ref(false);
const isOpenSearch = ref(false);

const showCart = () => {
  alert(" Làm gì có 5 nào! \n Bị lừa rồi");
};

const showMenu = () => {
  isOpenMenu.value = !isOpenMenu.value;
  console.log(isOpenMenu.value);
};

const showSearch = () => {
  isOpenSearch.value = !isOpenSearch.value;
};

const data = ref([
  {
    id: 1,
    name: "Máy lọc nước",
    itemChil: [
      { id: 1, name: "chil1" },
      { id: 2, name: "chil2" },
      { id: 3, name: "chil3" },
    ],
  },
  {
    id: 2,
    name: "Bếp từ",
    itemChil: [
      { id: 1, name: "chil1" },
      { id: 2, name: "chil2" },
      { id: 3, name: "chil3" },
    ],
  },
  {
    id: 3,
    name: "Bình nước nóng",
    itemChil: [
      { id: 1, name: "chil1" },
      { id: 2, name: "chil2" },
      { id: 3, name: "chil3" },
    ],
  },
  {
    id: 4,
    name: "Linh kiện lõi lọc",
  },
  {
    id: 5,
    name: "Tin tức",
  },
  {
    id: 6,
    name: "Giới thiệu",
  },
  {
    id: 7,
    name: "Bảo hành",
  },
  {
    id: 8,
    name: "Thư viện",
    itemChil: [
      { id: 1, name: "chil1" },
      { id: 2, name: "chil2" },
      { id: 3, name: "chil3" },
    ],
  },
]);
</script>

<style scoped></style>
