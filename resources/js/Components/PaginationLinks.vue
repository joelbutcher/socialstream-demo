<script setup>
import {computed} from 'vue';

defineEmits(['fetchData']);

const props = defineProps({
  paginator: {
    type: Object,
    required: true,
    default: {
      current_page: 1,
      data: [],
      first_page_url: ',',
      from: 1,
      last_page: 1,
      last_page_url: '',
      links: [],
      next_page_url: ',',
      path: '',
      per_page: 15,
      prev_page_url: null,
      to: 15,
      total: 100,
    },
  },
});

const count = computed(() => props.paginator.data.length);
const firstItem = computed(() => count > 0 ? (props.paginator.current_page - 1) * props.paginator.per_page + 1 : null);
const lastItem = computed(() => count > 0 ? firstItem + count - 1 : null);
const prevPage = computed(() => props.paginator.current_page - 1);
const nextPage = computed(() => props.paginator.current_page + 1);
const onFirstPage = computed(() => props.paginator.current_page <= 1);
const hasMorePages = computed(() => props.paginator.current_page < props.paginator.last_page);
const paginationLinks = computed(() => props.paginator?.links?.filter((link) => !['&laquo; Previous', 'Next &raquo;'].includes(link.label)));
</script>

<template>
  <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-4 md:px-0">
    <div class="flex justify-between flex-1 md:hidden">
      <template v-if="onFirstPage">
        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 cursor-default leading-5 rounded-md">
          &laquo; Previous
        </span>
      </template>

      <template v-else>
        <button
            @click="$emit('fetchData', paginator.last_page)"
            :href="paginator.last_page_url"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 leading-5 rounded-md hover:text-slate-500 dark:hover:text-slate-300 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 dark:active:bg-slate-900 active:text-slate-700 dark:active:text-slate-300 transition ease-in-out duration-200"
        >
          &laquo; Previous
        </button>
      </template>

      <template v-if="hasMorePages">
        <button
            @click="$emit('fetchPage', nextPage)"
            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 leading-5 rounded-md hover:text-slate-500 dark:hover:text-slate-300 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 dark:active:bg-slate-900 active:text-slate-700 dark:active:text-slate-300 transition ease-in-out duration-200"
        >
          Next &raquo;
        </button>
      </template>

      <template v-else>
        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 cursor-default leading-5 rounded-md">
          Next &raquo;
        </span>
      </template>
    </div>

    <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
      <div>
        <p class="text-sm text-slate-700 dark:text-slate-300 leading-5">
          Showing
          <template v-if="firstItem">
            <span class="font-medium">{{ firstItem }}</span>
            to
            <span class="font-medium">{{ lastItem }}</span>
          </template>

          <template v-else>
            {{ count }}
          </template>

          of
          <span class="font-medium">
            {{ paginator.total }}
          </span>
          results
        </p>
      </div>

      <div>
        <span class="relative z-0 inline-flex shadow-sm rounded-md">
          <!-- Previous Page Link -->
          <template v-if="onFirstPage">
            <span aria-disabled="true" aria-label="&laquo; Previous">
              <span
                  class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 cursor-default rounded-l-md leading-5"
                  aria-hidden="true">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"/>
                </svg>
              </span>
            </span>
          </template>

          <template v-else>
            <button
                @click="$emit('fetchData', prevPage)"
               class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-500 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-l-md leading-5 hover:text-slate-500 dark:hover:text-slate-300 focus:z-10 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 active:text-slate-500 transition ease-in-out duration-200"
               aria-label="&laquo; Previous">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                      clip-rule="evenodd"/>
              </svg>
            </button>
          </template>

          <!-- Pagination Elements -->
          <template  v-for="link in paginationLinks">
            <!-- "Three Dots" Separator -->
            <template v-if="link.label === '...'">
              <span aria-disabled="true">
                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 cursor-default leading-5">
                  {{ link.label }}
                </span>
              </span>
            </template>

            <!-- Numerical Links -->
            <template v-else>
              <template v-if="link.active">
                <span aria-current="page">
                  <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 cursor-default leading-5">
                    {{ parseInt(link.label) }}
                  </span>
                </span>
              </template>

              <template v-else>
                <button
                    @click="$emit('fetchData', parseInt(link.label))"
                    rel="prev"
                    :aria-label="`Go to page ${parseInt(link.label)}`"
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 leading-5 hover:text-slate-500 dark:hover:text-slate-300 focus:z-10 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 dark:active:bg-slate-900 active:text-slate-700 transition ease-in-out duration-200"
                >
                  {{ parseInt(link.label) }}
                </button>
              </template>
            </template>
          </template>

          <!-- Next Page Link -->
          <template v-if="hasMorePages">
            <button
                @click="$emit('fetchData', nextPage)"
                rel="next"
                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-r-md leading-5 hover:text-slate-500 dark:hover:text-slate-300 focus:z-10 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 active:text-slate-500 transition ease-in-out duration-200"
               aria-label="Next &raquo;">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
              </svg>
            </button>
          </template>

          <template v-else>
            <span aria-disabled="true" aria-label="Next &raquo;">
              <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 cursor-default rounded-r-md leading-5" aria-hidden="true">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </span>
            </span>
          </template>
        </span>
      </div>
    </div>
  </nav>
</template>
