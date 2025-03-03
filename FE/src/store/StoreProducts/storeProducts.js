let autoClearTimeout = null;

const storeProducts = {
  namespaced: true,
  state: {
    allDataProducts: [],
    dataStoreProducts: [],
    dataStoreCart: [],
  },
  mutations: {
    //Product
    setAllDataProducts(state, payload) {
      state.allDataProducts = payload.allDataProducts;
    },
    setDataStoreProducts(state, payload) {
      state.dataStoreProducts = payload.dataStoreProducts;
    },
    clearDataStoreProducts(state) {
      state.dataStoreProducts = [];
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
      state.dataStoreCart.splice(0, state.dataStoreCart.length);
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
    clearDataStoreProducts({ commit }) {
      commit("clearDataStoreProducts");
    },

    deleteItemProduct({ commit }, itemId) {
      commit("removeItemProduct", itemId);
    },
    //Product

    //Cart
    clearDataStoreCart({ commit }) {
      commit("clearDataStoreCart");
      return Promise.resolve();
    },

    deleteItemCart({ commit }, itemId) {
      commit("removeItemCart", itemId);
    },
    updateItemCart({ commit }, updatedItem) {
      commit("updateItemCart", updatedItem);
    },

    //Cart
    startAutoClear({ dispatch }) {
      if (autoClearTimeout) {
        clearTimeout(autoClearTimeout);
      }

      autoClearTimeout = setTimeout(() => {
        dispatch("clearDataStoreProducts");
        dispatch("startAutoClear");
      }, 3600000); //1h
    },
  },
  getters: {
    getAllDataProduct: (state) => state.allDataProducts,
    getDataStoreProducts: (state) => state.dataStoreProducts,
    getDataStoreCart: (state) => state.dataStoreCart,
  },
};

export default storeProducts;
