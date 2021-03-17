<template>
  <app-layout>
    <template #header>
      <div class="max-w-7xl mx-auto">
        <div class="lg:flex lg:items-center lg:justify-between">
          <div class="flex-1 min-w-0">
            <h2
              class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate"
            >
              Product Details
            </h2>
          </div>
        </div>
      </div>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
              >
                <div
                  class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                  <div
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                  >
                    <div
                      class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                    >
                      <div>
                        <h2 class="text-lg font-bold">
                          {{ product.name }}
                        </h2>
                        <p class="text-gray-500">
                          Price:
                          {{ currency(product.price) }} | Quantity:
                          {{ product.total }}
                        </p>
                      </div>
                      <div>
                        <button
                          @click.prevent="hideModal = false"
                          type="button"
                          class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                          <svg
                            class="-ml-1 mr-2 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"
                            />
                          </svg>

                          Add movement
                        </button>
                      </div>
                    </div>
                  </div>
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Date / Time
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Quantity
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Type
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="movement in historic" :key="movement.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ date(movement.created_at) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          {{ movement.quantity }}
                        </td>
                        <td
                          :class="
                            movement.type == 'in'
                              ? 'text-green-500'
                              : 'text-red-500'
                          "
                          class="px-6 py-4 whitespace-nowrap"
                        >
                          <svg
                            v-if="movement.type == 'in'"
                            class="mx-1 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                            />
                          </svg>
                          <svg
                            v-if="movement.type == 'out'"
                            class="mx-1 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                            />
                          </svg>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div
      class="fixed z-10 inset-0 overflow-y-auto"
      :class="{ hidden: hideModal }"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >
        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3
                  class="text-lg leading-6 font-medium text-gray-900"
                  id="modal-headline"
                >
                  Add movement
                </h3>
                <div class="mt-2">
                  <div class="grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-10">
                      <label
                        for="quantity"
                        class="block text-sm font-medium text-gray-700"
                        >Quantity</label
                      >
                      <input
                        type="number"
                        name="quantity"
                        v-model="movement.quantity"
                        id="quantity"
                        min="0"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                      <span
                        class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
                      >
                        {{ errors.quantity ? errors.quantity[0] : "" }}
                      </span>
                    </div>

                    <div class="col-span-2">
                      <label
                        for="quantity"
                        class="block text-sm font-medium text-gray-700"
                        >Type</label
                      >
                      <select
                        id="type"
                        name="type"
                        v-model="movement.type"
                        class="mt-1 block w-full py-2 px-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option value="in">In</option>
                        <option value="out">Out</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              type="button"
              @click.prevent="addMovement"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Save
            </button>
            <button
              type="button"
              @click="hideModal = true"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
  },

  data: function () {
    return {
      movement: { quantity: 0, type: "in" },
      hideModal: true,
      errors: [],
    };
  },

  props: ["product", "historic"],
  methods: {
    currency: function (value) {
      if (!value) return "";
      return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
      }).format(value);
    },
    date: function (date) {
      return date.replace(/T/, " ").replace(/\..+/, "");
    },
    addMovement: function () {
      this.$inertia.post(
        `/products/${this.product.id}/movement`,
        {
          ...this.movement,
          _token: this.$page.props.csrf_token,
        },
        {
          errorBags: "productMovement",
          onError: (res) => {
            this.errors = res.productMovement;
            console.log(this.errors.quantity);
          },
          onSuccess: () => {
            this.movement.quantity = 0;
            this.movement.type = "in";
            this.hideModal = true;
            Swal.fire(
              "Success!",
              "Movement created successfully.",
              "success"
            ).then(() => window.location.reload);
          },
        }
      );
    },
  },
};
</script>

<style>
</style>