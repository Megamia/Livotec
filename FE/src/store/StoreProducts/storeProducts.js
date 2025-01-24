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
  },
  actions: {},
  getters: {
    getDataStoreProducts: (state) => state.dataStoreProducts,
  },
};

export default storeProducts;
