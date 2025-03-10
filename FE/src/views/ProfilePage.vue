<template>
  <div
    class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]"
  >
    <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
      <div
        class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12"
      >
        <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>

        <button
          href="#"
          class="flex items-center px-3 py-2.5 hover:text-indigo-900 rounded-full"
          :class="
            activePage == 0
              ? 'bg-slate-200 text-indigo-900 font-bold'
              : 'bg-white font-semibold'
          "
          @click="handleChangeActivePage(0)"
        >
          Thông tin tài khoản
        </button>
        <button
          href="#"
          class="flex items-center px-3 py-2.5 hover:text-indigo-900 rounded-full"
          @click="handleChangeActivePage(1)"
          :class="
            activePage == 1
              ? 'bg-slate-200 text-indigo-900 font-bold'
              : 'bg-white font-semibold'
          "
        >
          Đổi mật khẩu
        </button>
        <button
          href="#"
          class="flex items-center px-3 py-2.5 hover:text-indigo-900 rounded-full"
          @click="handleChangeActivePage(2)"
          :class="
            activePage == 2
              ? 'bg-slate-200 text-indigo-900 font-bold'
              : 'bg-white font-semibold'
          "
        >
          Theo dõi đơn hàng
        </button>
        <!-- <a
          href="#"
          class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full"
        >
          PRO Account
        </a> -->
      </div>
    </aside>
    <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
      <div class="p-2 md:p-4">
        <!-- Thong tin nguoi dung -->
        <div
          v-if="activePage == 0"
          class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg"
        >
          <h2 class="pl-6 text-2xl font-bold sm:text-xl">
            Thông tin tài khoản
          </h2>
          <div class="grid max-w-2xl mx-auto">
            <div class="items-center mt-8 text-[#202142]">
              <div
                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6"
              >
                <div class="w-full">
                  <label
                    for="first_name"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                    >Tên</label
                  >
                  <input
                    type="text"
                    id="first_name"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                    placeholder="Your first name"
                    v-model="profile.first_name"
                    required
                  />
                </div>

                <div class="w-full">
                  <label
                    for="last_name"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                    >Họ</label
                  >
                  <input
                    type="text"
                    id="last_name"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                    placeholder="Your last name"
                    v-model="profile.last_name"
                    required
                  />
                </div>
              </div>

              <div class="mb-2 sm:mb-6">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                  v-model="profile.email"
                  disabled
                />
              </div>
              <div class="mb-2 sm:mb-6">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                  >Số điện thoại</label
                >
                <input
                  type="email"
                  id="email"
                  class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                  v-model="profile.phone"
                  disabled
                />
              </div>
              
              <div class="mb-2 sm:mb-6">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                  >T</label
                >
                <input
                  type="email"
                  id="email"
                  class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                  v-model="profile.phone"
                  disabled
                />
              </div>
              <div class="mb-2 sm:mb-6">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                  >Số điện thoại</label
                >
                <input
                  type="email"
                  id="email"
                  class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                  v-model="profile.phone"
                  disabled
                />
              </div>
              <div class="mb-2 sm:mb-6">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                  >Số điện thoại</label
                >
                <input
                  type="email"
                  id="email"
                  class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                  v-model="profile.phone"
                  disabled
                />
              </div>
            </div>
          </div>
          <div>
            <div class="flex justify-end">
              <button
                type="submit"
                class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
              >
                Save
              </button>
            </div>
          </div>
        </div>
        <!-- Doi mat khau -->
        <div
          v-if="activePage == 1"
          class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg"
        >
          <h2 class="pl-6 text-2xl font-bold sm:text-xl">Đổi mật khẩu</h2>
          <div class="grid max-w-2xl mx-auto">
            <form @submit.prevent="handleSubmit">
              <div class="items-center mt-8 text-[#202142]">
                <input
                  type="text"
                  id="username"
                  name="username"
                  autocomplete="username"
                  style="display: none"
                />
                <div class="mb-2 sm:mb-6">
                  <label
                    for="old_password"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                    >Mật khẩu cũ</label
                  >
                  <div class="relative">
                    <input
                      :type="passwordVisibility.old ? 'text' : 'password'"
                      id="old_password"
                      class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                      v-model="passwordForm.old_password"
                      placeholder="Nhập mật khẩu cũ..."
                      autocomplete="current-password"
                      required
                    />
                    <button
                      type="button"
                      @click="passwordVisibility.old = !passwordVisibility.old"
                      class="absolute inset-y-0 right-2 flex items-center text-indigo-600"
                    >
                      <CdEye
                        class="text-[20px]"
                        v-if="passwordVisibility.old"
                      />
                      <CdEyeClosed class="text-[20px]" v-else />
                    </button>
                  </div>
                </div>
                <div class="mb-2 sm:mb-6">
                  <label
                    for="new_password"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                    >Mật khẩu mới</label
                  >
                  <div class="relative">
                    <input
                      :type="passwordVisibility.new ? 'text' : 'password'"
                      id="new_password"
                      class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                      v-model="passwordForm.new_password"
                      placeholder="Nhập mật khẩu mới..."
                      required
                      autocomplete="new-password"
                    />
                    <button
                      type="button"
                      @click="passwordVisibility.new = !passwordVisibility.new"
                      class="absolute inset-y-0 right-2 flex items-center text-indigo-600"
                    >
                      <CdEye
                        class="text-[20px]"
                        v-if="passwordVisibility.new"
                      />
                      <CdEyeClosed class="text-[20px]" v-else />
                    </button>
                  </div>
                </div>
                <div class="mb-2 sm:mb-6">
                  <label
                    for="confirm_password"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white"
                    >Xác nhận mật khẩu mới</label
                  >
                  <div class="relative">
                    <input
                      :type="passwordVisibility.confirm ? 'text' : 'password'"
                      id="confirm_password"
                      class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                      v-model="passwordForm.confirm_password"
                      placeholder="Nhập lại mật khẩu mới..."
                      required
                      autocomplete="new-password"
                    />
                    <button
                      type="button"
                      @click="
                        passwordVisibility.confirm = !passwordVisibility.confirm
                      "
                      class="absolute inset-y-0 right-2 flex items-center text-indigo-600"
                    >
                      <CdEye
                        class="text-[20px]"
                        v-if="passwordVisibility.confirm"
                      />
                      <CdEyeClosed class="text-[20px]" v-else />
                    </button>
                  </div>
                </div>
                <p v-if="errorMessage" class="text-red-600">
                  {{ errorMessage }}
                </p>
                <p v-if="successMessage" class="text-green-600">
                  {{ successMessage }}
                </p>
                <div class="flex justify-end">
                  <button
                    type="submit"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
                  >
                    Save
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { CdEye, CdEyeClosed } from "@kalimahapps/vue-icons";
import axios from "axios";
const router = useRouter();

const activePage = ref(0);
const profile = ref({
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
  province: "",
  district: "",
  subdistrict: "",
  address: "",
});

const errorMessage = ref("");
const successMessage = ref("");

const passwordVisibility = ref({
  old: false,
  new: false,
  confirm: false,
});

const passwordForm = ref({
  old_password: "",
  new_password: "",
  confirm_password: "",
});

const handleChangeActivePage = (value) => {
  activePage.value = value;
  console.log(activePage.value);
};

const fetchProfile = async () => {
  try {
    const response = await axios.post(
      `${import.meta.env.VITE_APP_URL_API_USER}/profile`,
      {},
      { withCredentials: true }
    );
    profile.value.first_name = response.data.first_name;
    profile.value.last_name = response.data.last_name;
    profile.value.email = response.data.email;
    profile.value.phone = response.data.additional_user?.phone || "";
    profile.value.province = response.data.additional_user?.province || "";
    profile.value.district = response.data.additional_user?.district || "";
    profile.value.subdistrict =
      response.data.additional_user?.subdistrict || "";
    profile.value.address = response.data.additional_user?.address || "";
    console.log(profile.value);
  } catch (error) {
    if (error.response && error.response.status === 401) {
      console.log("Bạn chưa đăng nhập. Đang chuyển hướng...");
      alert("Bạn chưa đăng nhập. Đang chuyển hướng...");
      router.push("/login");
    } else {
      console.log(error);
    }
  }
};
const handleSubmit = async () => {
  errorMessage.value = "";
  successMessage.value = "";
  console.log(passwordForm.value);

  // Kiểm tra xác nhận mật khẩu trước khi gửi
  if (passwordForm.value.new_password !== passwordForm.value.confirm_password) {
    errorMessage.value = "Mật khẩu mới không khớp.";
    return;
  }
  try {
    const response = await axios.post(
      `${import.meta.env.VITE_APP_URL_API_USER}/change-password`,
      {
        old_password: passwordForm.value.old_password,
        new_password: passwordForm.value.new_password,
      },
      { withCredentials: true }
    );

    successMessage.value = response.data.message;
    passwordForm.value.old_password = "";
    passwordForm.value.new_password = "";
    passwordForm.value.confirm_password = "";
    console.log(response.data);
  } catch (error) {
    if (error.response?.status === 422) {
      errorMessage.value = error.response.data.error || "Lỗi dữ liệu nhập vào.";
      console.log(errorMessage);
    } else {
      errorMessage.value = "Có lỗi xảy ra! Vui lòng thử lại.";
      console.log(errorMessage);
    }
  }
};

onMounted(fetchProfile);
</script>

<style scoped>
.text-red-600 {
  color: red;
}
.text-green-600 {
  color: green;
}
</style>
