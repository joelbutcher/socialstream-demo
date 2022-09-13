<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateTeamForm from '@/Pages/Teams/Partials/CreateTeamForm.vue';
</script>

<template>
  <AppLayout title="Create Team">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="text-xs">
          Teams / Create
        </div>

        <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight mt-2">
          Create Team
        </h2>
      </div>
    </template>

    <div class="max-w-7xl mx-auto py-4 md:py-10 sm:px-6 lg:px-8">
      <CreateTeamForm />
    </div>
  </AppLayout>
</template>
