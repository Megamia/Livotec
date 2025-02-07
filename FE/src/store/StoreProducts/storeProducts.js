const storeProducts = {
  namespaced: true,
  state: {
    dataStoreProducts: [],
    dataStoreCart: [],
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
    updateItemCart(state, updatedItem) {
      const index = state.dataStoreCart.findIndex(
        (item) => item.id === updatedItem.id
      );
      if (index !== -1) {
        state.dataStoreCart[index] = updatedItem;
      }
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
    updateItemCart({ commit }, updatedItem) {
      commit("updateItemCart", updatedItem);
    },
    //Cart
  },
  getters: {
    getDataStoreProducts: (state) => state.dataStoreProducts,

    getDataStoreCart: (state) => state.dataStoreCart,
  },
};

export default storeProducts;
