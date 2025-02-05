const storeProducts = {
  namespaced: true,
  state: {
    dataStoreProducts: [],
    dataStoreCart:[],
  },
  mutations: {
    //Product
    setDataStoreProducts(state, payload) {
      state.dataStoreProducts = payload.dataStoreProducts;
    },
    clearDataStoreProducts(state) {
      state.dataStoreProducts = null;
    },
    removeItemProduct(state, itemId) {
      state.dataStoreProducts = state.dataStoreProducts.filter(
        (item) => item.id !== itemId
      );
    },
    //Product

    //Cart
    setDataStoreCart(state, payload) {
      state.dataStoreCart = payload.dataStoreCart;
    },
    clearDataStoreCart(state) {
      state.dataStoreCart = null;
    },
    removeItemCart(state, itemId) {
      state.dataStoreCart = state.dataStoreCart.filter(
        (item) => item.id !== itemId
      );
    },
    //Cart
  },
  actions: {
    //Product
    deleteItemProduct({ commit }, itemId) {
      commit("removeItemProduct", itemId);
    },
    //Product

    //Cart
    deleteItemCart({ commit }, itemId) {
      commit("removeItemCart", itemId);
    },
    //Cart
  },
  getters: {
    getDataStoreProducts: (state) => state.dataStoreProducts,
  },
};

export default storeProducts;
