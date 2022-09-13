<script setup>
// Core
import {onMounted, ref} from 'vue';
import {EyeIcon} from '@heroicons/vue/24/outline';

// Components
import PaginationLinks from '@/Components/PaginationLinks.vue';
import ActionLink from '@/Components/ActionLink.vue';

let data = ref({
  data: [],
});

const props = defineProps({
  apiResourceRoute: String,
  keyName: {
    type: String,
    default: 'id',
  },
  viewRoute: String,
  viewRouteKeyName: {
    type: String,
    default: 'id',
  },
  headers: Object,
});

onMounted(() => {
  fetchData();
});

const fetchData = async (page = 1) => {
  fetch(route(props.apiResourceRoute, {page})).then(async (response) => {
    data.value = await response.json();
  });
};
</script>

<template>
  <template v-if="data.data.length > 0">
    <div class="hidden md:block">
      <table class="min-w-full bg-white dark:bg-slate-800 overflow-hidden shadow sm:shadow-lg sm:rounded-lg table-fixed">
        <thead class="bg-slate-700 dark:bg-slate-900">
        <tr>
          <th scope="col" class="p-4">
            <span class="sr-only">ID</span>
          </th>
          <th scope="col" v-for="header in Object.values(headers)"
              class="uppercase text-white text-left font-bold tracking-wider text-xs py-3 px-6 ">
            {{ header }}
          </th>
          <th scope="col" class="uppercase text-white text-left font-bold tracking-wider text-xs py-3 px-6 ">
            <span class="sr-only">View</span>
          </th>
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 dark:divide-slate-800 bg-white dark:bg-slate-700">
          <template v-for="item in data.data">
            <tr class="bg-white hover:bg-slate-50 dark:bg-slate-800 dark:hover:bg-slate-800/70 transition duration-300">
              <td class="p-4 w-4 dark:text-white">
                {{ item[keyName] }}
              </td>
              <td v-for="key in Object.keys(headers)"
                  class="py-4 px-6 text-sm font-medium text-slate-900 dark:text-slate-200 whitespace-nowrap">
                {{ item[key] }}
              </td>
              <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                <ActionLink :href="route(viewRoute, item[viewRouteKeyName])">
                  <span>View</span>
                  <EyeIcon class="w-5 h-5 ml-2 text-slate-700 dark:text-white"/>
                </ActionLink>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </template>

  <template v-else>
    <div class="p-6 text-slate-500 dark:text-slate-400 text-center">
      No data to show
    </div>
  </template>

  <PaginationLinks
      :paginator="data"
      @fetch-data="fetchData"
      class="mt-10"
  />
</template>
