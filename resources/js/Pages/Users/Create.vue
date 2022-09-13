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
        <div class="flex items-center justify-between">
          <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            New Users
          </h2>
        </div>
      </div>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <CreateUserForm :password="password"/>
      </div>
    </div>
  </AppLayout>
</template>
