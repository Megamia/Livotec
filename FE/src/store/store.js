import { createStore } from "vuex";
import storeProducts from "./StoreProducts/storeProducts";
import createPersistedState from "vuex-persistedstate";

const store = createStore({
  modules: {
    product: storeProducts,
    // user: storeDataUser,
    // address: storeDataAddress,
    // product: storeDataProduct,
    // voucher: storeDataVoucher,
  },
  mutations: {
    // clearAllData(state) {
    //   store.commit("user/clearDataUser");
    //   store.commit("address/clearDataAddress");
    //   store.commit("product/clearDataProduct");
    //   store.commit("voucher/code/clearDataVoucherCode");
    // },
  },
  plugins: [
    createPersistedState({
      key: "vuex",
      paths: ["product.dataStoreProducts", "product.dataStoreCart"],
    }),
  ],
});

export default store;
