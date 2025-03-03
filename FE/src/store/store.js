import { createStore } from "vuex";
import storeProducts from "./StoreProducts/storeProducts";
import createPersistedState from "vuex-persistedstate";
import CryptoJS from "crypto-js";
import user from './modules/user';

const SECRET_KEY = "your-secret-key";

const encryptData = (data) => {
  try {
    return CryptoJS.AES.encrypt(JSON.stringify(data), SECRET_KEY).toString();
  } catch (error) {
    console.error("Encryption error:", error);
    return null;
  }
};

const decryptData = (cipherText) => {
  try {
    const bytes = CryptoJS.AES.decrypt(cipherText, SECRET_KEY);
    return JSON.parse(bytes.toString(CryptoJS.enc.Utf8));
  } catch (error) {
    console.error("Decryption error:", error);
    return null;
  }
};

const store = createStore({
  modules: {
    product: storeProducts,
    user: user,
  },
  plugins: [
    createPersistedState({
      key: "vuex",
      paths: [
        "product.dataStoreProducts",
        "product.dataStoreCart",
        "product.allDataProducts",
      ],
      storage: {
        getItem: (key) => {
          const data = localStorage.getItem(key);
          // return data ? decryptData(data) : null;
          return data ? data : null;
        },
        setItem: (key, value) => {
          // const encryptedData = encryptData(value);
          localStorage.setItem(key, value);
        },
        removeItem: (key) => localStorage.removeItem(key),
      },
      // storage: {
      //   getItem: (key) => {
      //     const data = localStorage.getItem(key);
      //     return data ? JSON.parse(data) : null;
      //   },
      //   setItem: (key, value) => {
      //     localStorage.setItem(key, JSON.stringify(value));
      //   },
      //   removeItem: (key) => localStorage.removeItem(key),
      // },
    }),
  ],
});

export default store;
