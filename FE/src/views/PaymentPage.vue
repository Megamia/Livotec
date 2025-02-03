<template>
  <DefaultLayout>
    <div class="container">
      <div class="w-full border-b-[1px] border-gray-300 py-3">
        <span class="text-[#38B6AC] font-bold">Thanh toán</span>
      </div>
      <div>
        <h1 class="text-3xl text-[#38B6AC] font-bold my-3">Thanh toán</h1>
        <div class="w-full">
          <div class="text-[14px] font-medium">
            Have a coupon?
            <a class="text-blue-500 font-medium">Click here to enter your code</a>
          </div>
          <a-form ref="formRef" :model="formState" :rules="rules" layout="vertical">
            <a-flex class="w-full gap-10">
              <a-flex vertical class="flex-wrap w-full flex-1">
                <h3 class="text-xl font-medium">Billing details</h3>
                <a-form-item ref="name" name="name" class="w-full">
                  <template #label>
                    <span class="text-base">Họ và tên</span>
                  </template>
                  <a-input v-model:value="formState.name" placeholder="Nhập họ và tên" />
                </a-form-item>
                <a-flex class="w-full gap-8">
                  <a-form-item ref="phone" name="phone" class="w-full">
                    <template #label>
                      <span class="text-base">Phone</span>
                    </template>
                    <a-input v-model:value="formState.phone" placeholder="Nhập số điện thoại" />
                  </a-form-item>
                  <a-form-item ref="email" name="email" class="w-full">
                    <template #label>
                      <span class="text-base">Email address</span>
                    </template>
                    <a-input v-model:value="formState.email" placeholder="Nhập địa chỉ email" />
                  </a-form-item>
                </a-flex>
                <a-flex class="w-full gap-8">
                  <a-form-item name="province" class="w-full">
                    <template #label>
                      <span class="text-base">Tỉnh/Thành phố</span>
                    </template>
                    <a-select
                      v-model:value="formState.province"
                      @change="onProvinceChange"
                      placeholder="Chọn Tỉnh/Thành phố"
                    >
                      <a-select-option v-for="province in provinces" :key="province.code" :value="province.code">
                        {{ province.name }}
                      </a-select-option>
                    </a-select>
                  </a-form-item>
                  <a-form-item name="district" class="w-full">
                    <template #label>
                      <span class="text-base">Quận/Huyện</span>
                    </template>
                    <a-select
                      v-model:value="formState.district"
                      @change="onDistrictChange"
                      placeholder="Chọn Quận/Huyện"
                    >
                      <a-select-option v-for="district in districts" :key="district.code" :value="district.code">
                        {{ district.name }}
                      </a-select-option>
                    </a-select>
                  </a-form-item>
                </a-flex>
                <a-flex class="w-full gap-8">
                  <a-form-item name="subdistrict" class="w-full">
                    <template #label>
                      <span class="text-base">Xã/Phường/Thị trấn</span>
                    </template>
                    <a-select
                      v-model:value="formState.subdistrict"
                      placeholder="Chọn Xã/Phường/Thị trấn"
                    >
                      <a-select-option v-for="ward in wards" :key="ward.code" :value="ward.code">
                        {{ ward.name }}
                      </a-select-option>
                    </a-select>
                  </a-form-item>
                  <a-form-item ref="phone" name="phone" class="w-full">
                    <template #label>
                      <span class="text-base">Street address</span>
                    </template>
                    <a-input v-model:value="formState.address" placeholder="Nhập địa chỉ cụ thể" />
                  </a-form-item>
                </a-flex>
              </a-flex>
              <a-flex vertical class="w-full flex-1">
                <h3>
                  <a-checkbox v-model:checked="checked">
                    <span class="text-xl font-medium flex gap-2 text-center">Ship to a different address?</span>
                  </a-checkbox>
                </h3>
                <a-form-item label="Order notes (optional)" name="notes">
                  <a-textarea
                    v-model:value="formState.notes"
                    placeholder="Notes about your order, e.g. special notes for delivery."
                  />
                </a-form-item>
              </a-flex>
            </a-flex>
            <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
              <a-button type="primary" @click="onSubmit">Create</a-button>
              <a-button style="margin-left: 10px" @click="resetForm">Reset</a-button>
            </a-form-item>
          </a-form>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "./DefaultLayout.vue";
import { reactive, ref } from "vue";
import axios from "axios";

const formRef = ref();
const checked = ref(false);
const formState = reactive({
  name: "",
  phone: "",
  email: "",
  province: "",
  district: "",
  subdistrict: "",
  address: "",
  notes: "",
});

const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);

const host = "https://provinces.open-api.vn/api/";

const fetchProvinces = () => {
  axios
    .get(`${host}?depth=1`)
    .then((response) => {
      provinces.value = response.data;
    });
};

const onProvinceChange = () => {
  const provinceCode = formState.province;
  if (provinceCode) {
    axios
      .get(`${host}p/${provinceCode}?depth=2`)
      .then((response) => {
        districts.value = response.data.districts;
        wards.value = [];
      });
  }
};

const onDistrictChange = () => {
  const districtCode = formState.district;
  if (districtCode) {
    axios
      .get(`${host}d/${districtCode}?depth=2`)
      .then((response) => {
        wards.value = response.data.wards;
      });
  }
};

const rules = {
  name: [{ required: true, message: "Vui lòng nhập họ và tên", trigger: "change" }],
  email: [{ required: true, message: "Vui lòng nhập địa chỉ email", trigger: "change" }],
  phone: [{ required: true, message: "Vui lòng nhập số điện thoại", trigger: "change" }],
  province: [{ required: true, message: "Vui lòng chọn tỉnh/thành phố", trigger: "change" }],
  district: [{ required: true, message: "Vui lòng chọn quận/huyện", trigger: "change" }],
  subdistrict: [{ required: true, message: "Vui lòng chọn xã/phường/thị trấn", trigger: "change" }],
};

const onSubmit = () => {
  formRef.value.validate().then(() => {
    console.log("values", formState);
  }).catch((error) => {
    console.log("error", error);
  });
};

const resetForm = () => {
  formRef.value.resetFields();
};

fetchProvinces();
</script>

<style scoped></style>
