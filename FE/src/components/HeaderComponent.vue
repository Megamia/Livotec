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
      <a-flex
        class="text-white flex-wrap gap-x-[8px]"
        v-for="item in dataProducts"
        :key="item.id"
      >
        <a-dropdown
          class="flex flex-row items-center gap-1 hover:text-white text-nowrap basis-1/7"
          v-for="itemChil in item"
          :key="itemChil.id"
        >
          <a class="ant-dropdown-link" @click.prevent>
            {{ itemChil.category.name }}
            <AnFilledCaretDown v-if="dataProducts.length >= 1" />
          </a>
          <!-- <template #overlay>
            <a-menu v-if="item.itemChil">
              <a-menu-item v-for="itemChil in item.itemChil" :key="itemChil.id">
                {{ itemChil.name }}
              </a-menu-item>
            </a-menu>
          </template> -->
        </a-dropdown>
      </a-flex>
    </a-flex>
    <a-flex class="items-center justify-end gap-4">
      <BxSearch class="icon iconHidden" @click="showSearch" />
      <SearchComponent v-if="isOpenSearch" @close-search="showSearch" />
      <a-badge
        :count="quantityProductInCart"
        show-zero
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
import { ref, onMounted, computed } from "vue";
import "./header.css";
import {
  BxSearch,
  BsCart2,
  AnOutlinedMenu,
  AnOutlinedUser,
  AnFilledCaretDown,
} from "@kalimahapps/vue-icons";
import store from "@/store/store";
import { useRouter } from "vue-router";
import axios from "axios";
import { data } from "autoprefixer";

const router = useRouter();
const isLogin = ref(false);

const handleLogout = () => {
  if (confirm("Chắc chắn muốn đăng xuất?")) {
    isLogin.value = false;
    localStorage.removeItem("token");
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
onMounted(() => {
  fetchData();
  getdata();
});
const dataProducts = ref({});

const getdata = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/products`
    );
    const products = response.data;
    const groupedByCategory = {};
    products.forEach((product) => {
      if (!groupedByCategory[product.category.id]) {
        groupedByCategory[product.category.id] = [];
      }
      groupedByCategory[product.category.id].push(product);
    });

    for (const categoryId in groupedByCategory) {
      const productsInCategory = groupedByCategory[categoryId];
      groupedByCategory[categoryId] = getRandomProducts(productsInCategory, 4);
    }

    dataProducts.value = groupedByCategory;
    console.log(dataProducts.value);
  } catch (e) {
    console.log("Error: ", e);
  }
};
const getRandomProducts = (array, n) => {
  const shuffled = array.sort(() => 0.5 - Math.random());
  return shuffled.slice(0, n);
};

const isOpenMenu = ref(false);
const isOpenSearch = ref(false);
const quantityProductInCart = computed(() => {
  return store.getters["product/getDataStoreCart"].length;
});
const showCart = () => {
  router.push("/cart");
};

const showMenu = () => {
  isOpenMenu.value = !isOpenMenu.value;
};

const showSearch = () => {
  isOpenSearch.value = !isOpenSearch.value;
};
</script>

<style scoped></style>
