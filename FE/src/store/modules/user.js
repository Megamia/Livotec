const state = {
  first_name: "",
  avatar: "",
};

const mutations = {
  SET_USER(state, user) {
    state.first_name = user.first_name;
    state.avatar = user.avatar;
  },
  SET_FIRST_NAME(state, first_name) {
    state.first_name = first_name;
  },
  SET_AVATAR(state, avatar) {
    state.avatar = avatar;
  },
  CLEAR_USER(state) {
    state.first_name = "";
    state.avatar = "";
  },
};

const actions = {
  updateUser({ commit }, user) {
    commit("SET_USER", user);
  },
  updateFirstName({ commit }, first_name) {
    commit("SET_FIRST_NAME", first_name);
  },
  updateAvatar({ commit }, avatar) {
    commit("SET_AVATAR", avatar);
  },
  clearDataUser({ commit }) {
    commit("CLEAR_USER"); // Gọi mutation để xóa dữ liệu
  },
};

const getters = {
  getUser: (state) => state,
  getFirstName: (state) => state.first_name,
  getAvatar: (state) => state.avatar,
};

export default {
  namespaced: true, // Để tránh xung đột với các module khác
  state,
  mutations,
  actions,
  getters,
};
