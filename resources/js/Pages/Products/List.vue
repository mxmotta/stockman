<template>
  <app-layout>
    <template #header>
      <div class="max-w-7xl mx-auto">
        <div class="lg:flex lg:items-center lg:justify-between">
          <div class="flex-1 min-w-0">
            <h2
              class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate"
            >
              Products
            </h2>
          </div>
          <div class="mt-5 flex lg:mt-0 lg:ml-4">
            <form class="relative">
              <svg
                width="20"
                height="20"
                fill="currentColor"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                />
              </svg>
              <input
                class="focus:border-light-blue-500 focus:ring-1 focus:ring-light-blue-500 focus:outline-none w-full text-sm text-black placeholder-gray-500 border border-gray-200 rounded-md py-2 pl-10"
                type="text"
                v-model="search"
                aria-label="Filter products"
                placeholder="Filter products"
              />
            </form>
            <span class="sm:ml-3">
              <inertia-link
                :href="route('products.add')"
                type="button"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                <svg
                  class="-ml-1 mr-2 h-5 w-5"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 20 20"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"
                  />
                </svg>
                Add products
              </inertia-link>
            </span>
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
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          ID
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Name
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Price
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                          Quantity
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Actions</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr
                        v-for="(product, index) in productsFiltered"
                        :key="index"
                      >
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm font-medium text-gray-900">
                            {{ product.id }}
                          </div>
                          <div class="text-sm text-gray-500">
                            <!-- jane.cooper@example.com -->
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900">
                            {{ product.name }}
                          </div>
                          <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900">
                            {{ currency(product.price) }}
                          </div>
                          <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold"
                          >
                            0
                          </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                          <button
                            @click.prevent="deleteProduct(product.id)"
                            type="button"
                            class="inline-flex items-center justify-items-center text-center px-2 py-2 text-sm font-medium text-red-400 hover:text-red-600 focus:outline-none"
                          >
                            <svg
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
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                              />
                            </svg>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div
                    class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                  >
                    <div class="flex-1 flex justify-between sm:hidden">
                      <a
                        href="#"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                      >
                        Previous
                      </a>
                      <a
                        href="#"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
                      >
                        Next
                      </a>
                    </div>
                    <div
                      class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                    >
                      <div></div>
                      <div>
                        <nav
                          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                          aria-label="Pagination"
                        >
                          <a
                            href="#"
                            @click.prevent="prevPage"
                            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                          >
                            <span class="sr-only">Previous</span>
                            <!-- Heroicon name: solid/chevron-left -->
                            <svg
                              class="h-5 w-5"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                              aria-hidden="true"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                              />
                            </svg>
                          </a>
                          <a
                            v-for="n in pages"
                            :key="n"
                            @click.prevent="currentPage = n"
                            href="#"
                            :class="activePage(n)"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                          >
                            {{ n }}
                          </a>
                          <a
                            href="#"
                            @click.prevent="nextPage"
                            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                          >
                            <span class="sr-only">Next</span>
                            <!-- Heroicon name: solid/chevron-right -->
                            <svg
                              class="h-5 w-5"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                              aria-hidden="true"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                              />
                            </svg>
                          </a>
                        </nav>
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
import Swal from "sweetalert2";

export default {
  components: {
    AppLayout,
  },

  data() {
    return {
      currentPage: 1,
      pageSize: 10,
      search: "",
      pages: 0,
      productsFiltered: [],
    };
  },

  props: ["products"],

  mounted: function () {    
    this.filteringProducts();
  },

  watch: {
    currentPage: function () {
      this.filteringProducts();
    },
    search: function () {
      this.filteringProducts();
    },
  },

  methods: {
    filteringProducts: function () {
      var products = this.products.filter((row) => {
        return this.search
          .toLowerCase()
          .split(" ")
          .every((v) => {
            return row.name.toLowerCase().includes(v);
          });
      });

      var paginated = [...products].filter((row, index) => {
        let start = (this.currentPage - 1) * this.pageSize;
        let end = this.currentPage * this.pageSize;
        if (index >= start && index < end) return true;
      });

      this.pages = Math.ceil(products.length / this.pageSize);
      this.productsFiltered = paginated;
    },
    activePage: function (value) {
      return {
        active: this.currentPage == value,
      };
    },
    currency: function (value) {
      if (!value) return "";
      return new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
      }).format(value);
    },
    nextPage: function () {
      if (this.currentPage * this.pageSize < this.products.length)
        this.currentPage++;
    },
    prevPage: function () {
      if (this.currentPage > 1) this.currentPage--;
    },
    deleteProduct: function (id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(`/products/${id}/delete`)
            .then((res) => {
              this.productsFiltered = this.productsFiltered.filter(
                (item) => item.id != id
              );
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })
            .catch((res) => console.log(res));
        }
      });
    },
  },
};
</script>

<style scoped>
.active {
  color: #fff;
  background-color: #5648ec;
}
</style>