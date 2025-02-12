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
      <a-flex class="text-white gap-x-[8px] flex-wrap">
        <a-dropdown
          v-for="item in data"
          :key="item.id"
          class="flex flex-row items-center gap-1 hover:text-white text-nowrap basis-1/7"
        >
          <a class="ant-dropdown-link" @click.prevent>
            {{ item.category }}
            <AnFilledCaretDown v-if="item.products.length>=1" />
          </a>

          <template #overlay>
            <a-menu v-if="item">
              <a-flex class="p-[15px]" vertical>
                <span
                  class="text-[#555] text-[16px] font-bold pb-[5px] uppercase"
                  >Sản phẩm nổi bật</span
                >
                <a-flex horizontal>
                  <a-menu-item
                    v-for="itemChil in item.products"
                    :key="itemChil.id"
                  >
                    <img
                      :src="itemChil.image.path"
                      class="w-[110px] h-[100px]"
                      v-if="itemChil.image.path"
                    />
                    <!-- <img
                      src="https://livotec.com/wp-content/uploads/2024/04/livotec638-mn.png"
                      class="w-[110px] h-[100px]"
                    /> -->
                    <span
                      class="justify-center flex flex-1 mt-[10px] uppercase font-semibold text-[14px] hover:text-[#51c9a9]"
                    >
                      {{ itemChil.name }}
                    </span>
                  </a-menu-item>
                </a-flex>
              </a-flex>
            </a-menu>
          </template>
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

const data = ref({});

const getdata = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_APP_URL_API_PRODUCT}/products`
    );
    const categoryMap = {};

    response.data.forEach((product) => {
      if (product.category && product.category.name) {
        const categoryName = product.category.name;

        if (!categoryMap[categoryName]) {
          categoryMap[categoryName] = [];
        }

        categoryMap[categoryName].push(product);
      }
    });

    const categorizedProducts = Object.keys(categoryMap).map((category) => {
      const shuffled = categoryMap[category].sort(() => 0.5 - Math.random());
      return {
        category,
        products: shuffled.slice(0, 4),
      };
    });
    data.value = categorizedProducts;
    console.log(data.value);
  } catch (e) {
    console.log("Error: ", e);
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

// const data = ref([
//   {
//     id: 1,
//     name: "Máy lọc nước",
//     itemChil: [
//       { id: 1, name: "chil1" },
//       { id: 2, name: "chil2" },
//       { id: 3, name: "chil3" },
//     ],
//   },
//   {
//     id: 2,
//     name: "Bếp từ",
//     itemChil: [
//       { id: 1, name: "chil1" },
//       { id: 2, name: "chil2" },
//       { id: 3, name: "chil3" },
//     ],
//   },
//   {
//     id: 3,
//     name: "Bình nước nóng",
//     itemChil: [
//       { id: 1, name: "chil1" },
//       { id: 2, name: "chil2" },
//       { id: 3, name: "chil3" },
//     ],
//   },
//   {
//     id: 4,
//     name: "Linh kiện lõi lọc",
//   },
//   {
//     id: 5,
//     name: "Tin tức",
//   },
//   {
//     id: 6,
//     name: "Giới thiệu",
//   },
//   {
//     id: 7,
//     name: "Bảo hành",
//   },
//   {
//     id: 8,
//     name: "Thư viện",
//     itemChil: [
//       { id: 1, name: "chil1" },
//       { id: 2, name: "chil2" },
//       { id: 3, name: "chil3" },
//     ],
//   },
// ]);

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
