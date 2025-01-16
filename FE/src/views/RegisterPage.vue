<template>
  <div
    class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
        class="mx-auto h-10 w-auto"
        src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      />
      <h2
        class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900"
      >
        Register an account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form
        class="space-y-6"
        action="#"
        method="POST"
        @submit.prevent="handleRegister"
      >
        <div>
          <label
            for="first_name"
            class="block text-sm/6 font-medium text-gray-900 text-left"
            >First name</label
          >
          <div class="mt-2">
            <input
              type="text"
              v-model="dataForm.first_name"
              name="first_name"
              id="first_name"
              autocomplete="first_name"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
        </div>

        <div>
          <label
            for="Email"
            class="block text-sm/6 font-medium text-gray-900 text-left"
            >Email</label
          >
          <div class="mt-2">
            <input
              type="email"
              v-model="dataForm.email"
              name="Email"
              id="Email"
              autocomplete="Email"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
        </div>

        <div>
          <label
            for="password"
            class="block text-sm/6 font-medium text-gray-900 text-left"
            >Password</label
          >
          <div class="mt-2">
            <input
              type="password"
              v-model="dataForm.password"
              name="password"
              id="password"
              autocomplete="password"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label
              for="password_confirmation"
              class="block text-sm/6 font-medium text-gray-900"
              >Password confirm</label
            >
          </div>
          <div class="mt-2">
            <input
              type="password"
              v-model="dataForm.password_confirmation"
              name="password_confirmation"
              id="password_confirmation"
              autocomplete="current-password"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Register
          </button>
        </div>
        <p class="mt-10 text-center text-sm/6 text-gray-500">
          Have an account?
          {{ " " }}
          <a
            href="/login"
            class="font-semibold text-indigo-600 hover:text-indigo-500"
            >Login now</a
          >
        </p>
      </form>
    </div>
  </div>
</template>
<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const dataForm = ref({
  first_name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const handleRegister = async () => {
  try {
    const response = await axios.post(
      `${import.meta.env.VITE_APP_URL_API}/signup`,
      {
        email: dataForm.value.email,
        first_name: dataForm.value.first_name,
        password: dataForm.value.password,
        password_confirmation: dataForm.value.password_confirmation,
      }
    );
    if (response.status === 200) {
      console.log("Register success");
      router.push("/login");
    } else {
      console.log("Register faile");
    }
  } catch (e) {
    console.log("Error: ", e);
  }
};
</script>
