<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';

// Layouts
import AppLayout from '@/Layouts/AppLayout.vue';

// Partials
import UpdateUserForm from '@/Pages/Users/Partials/UpdateUserForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import DeleteUserForm from '@/Pages/Users/Partials/DeleteUserForm.vue';

defineProps({
  images: Array,
  data: Object,
});
</script>

<template>
  <AppLayout :title="`${data.full_name} – Users`">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="mt-2 text-xs text-blue-600 dark:text-blue-400">
          <Link :href="route('users.index')" class="hover:underline">Users</Link>
          <span class="text-slate-500 dark:text-slate-300">
          / {{ data.full_name }}</span>
        </div>

        <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight mt-2">
          Users
        </h2>
      </div>
    </template>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <UpdateUserForm :user="data"/>

      <SectionBorder/>

      <DeleteUserForm :user="data" />
    </div>
  </AppLayout>
</template>
