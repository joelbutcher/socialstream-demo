<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateUserForm from '@/Pages/Users/Partials/CreateUserForm.vue';

defineProps({
  password: String,
})
</script>

<template>
  <AppLayout title="Create User">
     <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="text-xs">
          Users / Create
        </div>

        <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight mt-2">
          Create User
        </h2>
      </div>
    </template>

    <div class="max-w-7xl mx-auto py-4 md:py-10 sm:px-6 lg:px-8">
      <CreateUserForm :password="password"/>
    </div>
  </AppLayout>
</template>
