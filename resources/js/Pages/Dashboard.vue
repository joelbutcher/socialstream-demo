<script setup>
// Layout
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 md:px-4 lg:px-8">
        <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
          Dashboard
        </h2>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto md:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl md:rounded-lg">
          <Welcome />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
