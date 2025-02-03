const storeProducts = {
  namespaced: true,
  state: {
    dataStoreProducts: [],
  },
  mutations: {
    setDataStoreProducts(state, payload) {
      state.dataStoreProducts = payload.dataStoreProducts;
    },
    clearDataStoreProducts(state) {
      state.dataStoreProducts = null;
    },
    removeItem(state, itemId) {
      state.dataStoreProducts = state.dataStoreProducts.filter(
        (item) => item.id !== itemId
      );
    },
  },
  actions: {
    deleteItem({ commit }, itemId) {
      commit("removeItem", itemId);
    },
  },
  getters: {
    getDataStoreProducts: (state) => state.dataStoreProducts,
  },
};

export default storeProducts;
