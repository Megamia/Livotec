let autoClearTimeout = null;

const storeProducts = {
  namespaced: true,
  state: {
    dataStoreProducts: [],
    dataStoreCart: [],
    autoClearTimeout: null,
  },
  mutations: {
    //Product
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
    setAutoClearTimeout(state, timeout) {
      state.autoClearTimeout = timeout;
    },
    clearAutoClearTimeout(state) {
      if (state.autoClearTimeout) {
        clearTimeout(state.autoClearTimeout);
        state.autoClearTimeout = null;
      }
    },
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
      localStorage.removeItem("vuex");
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
        console.log("Clearing cart...");
        dispatch("clearDataStoreCart");
        dispatch("startAutoClear");
      }, 3600000); 
    },

    stopAutoClear({ commit, state }) {
      if (state.autoClearTimeout) {
        clearTimeout(state.autoClearTimeout);
        commit("clearAutoClearTimeout");
      }
    },
  },
  getters: {
    getDataStoreProducts: (state) => state.dataStoreProducts,
    getDataStoreCart: (state) => state.dataStoreCart,
  },
};

export default storeProducts;
