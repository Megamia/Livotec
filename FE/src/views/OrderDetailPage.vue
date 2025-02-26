<template>
  <DefaultLayout>
    <div class="container mb-[3rem]">
      <div class="w-full border-b-[1px] border-gray-300 py-3">
        <span class="text-[#38B6AC] font-bold">Thanh toán</span>
      </div>
      <div>
        <h1 class="text-3xl text-[#38B6AC] font-bold my-3">Thanh toán</h1>
        <p class="font-medium">Thank you. Your order has been received.</p>
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-5 md:flex-row items-center my-4 mx-8">
            <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
              <span class="text-[10px] font-bold">ORDER NUMBER:</span>
              <span class="font-bold">{{ orderNumber }}</span>
            </div>
            <div class="separator hidden md:flex"></div>
            <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
              <span class="text-[10px] font-bold">DATE:</span>
              <span class="font-bold">{{ date }}</span>
            </div>
            <div class="separator hidden md:flex"></div>
            <div class="flex flex-col items-center md:items-start mb-4 md:mb-0">
              <span class="text-[10px] font-bold">TOTAL:</span>
              <span class="font-bold text-teal-500">{{ total }}</span>
            </div>
            <div class="separator hidden md:flex"></div>
            <div class="flex flex-col items-center md:items-start">
              <span class="text-[10px] font-bold">PAYMENT METHOD:</span>
              <span class="font-bold">{{ paymentMethod }}</span>
            </div>
          </div>
          <h2 class="text-2xl font-medium">Our bank details</h2>
          <div class="mb-4">
            <p class="font-bold">Công ty TNHH Betod:</p>
            <div class="flex flex-col md:flex-row items-center my-1 mx-8 gap-5">
              <div
                class="flex flex-col items-center md:items-start mb-4 md:mb-0"
              >
                <span class="text-[10px] font-bold">BANK:</span>
                <span class="font-bold">{{ bank }}</span>
              </div>
              <div class="separator hidden md:flex"></div>
              <div
                class="flex flex-col items-center md:items-start mb-4 md:mb-0"
              >
                <span class="text-[10px] font-bold uppercase"
                  >Account number:</span
                >
                <span class="font-bold">{{ accountNumber }}</span>
              </div>
            </div>
          </div>
          <h2 class="text-2xl font-medium">Order details</h2>
          <a-flex class="w-full mb-[20px]"
            ><a-table
              :columns="columns"
              :data-source="data"
              :pagination="false"
              bordered
              class="w-full"
            >
              <template #bodyCell="{ column, record }">
                <template v-if="column.key === 'name'">
                  <a-flex gap="5" class="items-center">
                    {{ record.name }} <AkXSmall />
                    <span class="font-bold">{{ record.quantity }}</span>
                  </a-flex>
                </template>
                <template v-else-if="column.key === 'subtotal'">
                  <span class="text-[#02B6AC] text-[16px] font-bold">{{
                    formatCurrency(record.price * record.quantity)
                  }}</span>
                </template>
              </template>
              <template #summary>
                <a-table-summary-row>
                  <a-table-summary-cell
                    ><span class="font-semibold"
                      >Subtotal:</span
                    ></a-table-summary-cell
                  >
                  <a-table-summary-cell>
                    <span class="text-[#02B6AC] text-[16px] font-bold">{{
                      formatCurrency(totals.subtotal)
                    }}</span>
                  </a-table-summary-cell>
                </a-table-summary-row>
                <a-table-summary-row>
                  <a-table-summary-cell
                    ><span class="font-semibold"
                      >Shipping:</span
                    ></a-table-summary-cell
                  >
                  <a-table-summary-cell>
                    <span class="font-semibold">Free shipping</span>
                  </a-table-summary-cell>
                </a-table-summary-row>
                <a-table-summary-row>
                  <a-table-summary-cell
                    ><span class="font-semibold"
                      >Payment method:</span
                    ></a-table-summary-cell
                  >
                  <a-table-summary-cell>
                    <span class="font-semibold">Chuyển khoản ngân hàng</span>
                  </a-table-summary-cell>
                </a-table-summary-row>
                <a-table-summary-row>
                  <a-table-summary-cell
                    ><span class="font-semibold"
                      >Total:</span
                    ></a-table-summary-cell
                  >
                  <a-table-summary-cell>
                    <span class="text-[#02B6AC] text-[16px] font-bold">{{
                      formatCurrency(totals.subtotal)
                    }}</span>
                  </a-table-summary-cell>
                </a-table-summary-row>
              </template>
            </a-table>
          </a-flex>
        </div>
      </div>
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import DefaultLayout from "./DefaultLayout.vue";

const orderNumber = ref("4055");
const date = ref("24/02/2025");
const total = ref("2.190.000 đ");
const paymentMethod = ref("Chuyển khoản ngân hàng");
const bank = ref(
  "Ngân hàng TMCP Công Thương Việt Nam (Vietinbank) – Chi nhánh Ba Đình"
);
const accountNumber = ref("112609426688");
const data = ref([]);

const columns = ref([
  {
    key: "name",
    title: "Product",
    dataIndex: "name",
  },
  {
    key: "subtotal",
    title: "Total",
    dataIndex: "subtotal",
  },
]);

const totals = computed(() => {
  let subtotal = 0;
  data.value.forEach(({ price, quantity }) => {
    subtotal += price * quantity;
  });
  return {
    subtotal,
  };
});
const formatCurrency = (value) => {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(value);
};
</script>

<style scoped>
.separator {
  width: 1px;
  height: 32px;
  border-left: 1px dashed gray;
}
</style>
