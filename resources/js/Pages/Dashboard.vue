<script setup>
// Layout
import AppLayout from '@/Layouts/AppLayout.vue';

import Welcome from '@/Components/Welcome.vue';
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="max-w-7xl mx-auto py-10 md:px-3 lg:px-8">
      <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
        Dashboard
      </h2>

      <div class="py-12">
        <div class="max-w-7xl mx-auto">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <Welcome/>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
