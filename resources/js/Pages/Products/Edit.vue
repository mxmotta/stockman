<template>
  <app-layout>
    <template #header>
      <div class="max-w-7xl mx-auto">
        <div class="lg:flex lg:items-center lg:justify-between">
          <div class="flex-1 min-w-0">
            <h2
              class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate"
            >
              Edit Product
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
                  <div class="mt-10 sm:mt-0">
                    <div class="md:grid">
                      <div class="mt-5 md:mt-0">
                        <form
                          action="#"
                          method="POST"
                          @submit.prevent="editProduct"
                        >
                          <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                              <div class="grid grid-cols-12 gap-12 mt-5">
                                <div
                                  class="col-span-6 sm:col-span-3 lg:col-span-9"
                                >
                                  <label
                                    for="first_name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Name</label
                                  >
                                  <input
                                    type="text"
                                    name="first_name"
                                    v-model="product.name"
                                    id="first_name"
                                    autocomplete="given-name"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                  />
                                  <span
                                    class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
                                  >
                                  </span>
                                </div>

                                <div
                                  class="col-span-6 sm:col-span-3 lg:col-span-3"
                                >
                                  <label
                                    for="first_name"
                                    class="block text-sm font-medium text-gray-700"
                                    >Price</label
                                  >
                                  <div
                                    class="flex flex-wrap align-middle items-stretch w-full relative"
                                  >
                                    <div class="flex -mr-px">
                                      <span
                                        class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-300 px-3 whitespace-no-wrap text-grey-dark text-sm"
                                        >$</span
                                      >
                                    </div>
                                    <input
                                      type="text"
                                      v-model="product.price"
                                      class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-gray-300 rounded-r-md px-3 relative"
                                    />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div
                              class="px-4 py-3 bg-gray-50 text-right sm:px-6"
                            >
                              <button
                                type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              >
                                Save
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },

  props: ["product"],

  methods: {
    editProduct() {
      this.$inertia.post(`/products/${this.product.id}/update`, {
        ...this.product,
        _token: this.$page.props.csrf_token,
      });
    },
  },
};
</script>

<style>
</style>