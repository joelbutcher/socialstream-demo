<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';
import {PlusCircleIcon} from '@heroicons/vue/24/outline';

// Layout
import AppLayout from '@/Layouts/AppLayout.vue';

// Components
import Table from '@/Components/Table.vue';
import ActionLink from '@/Components/ActionLink.vue';

</script>

<template>
  <AppLayout title="My Teams">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="flex items-center justify-between">
          <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            My Teams
          </h2>

          <ActionLink :href="route('teams.create')">
            <PlusCircleIcon class="w-6 h-6 mr-2"/>
            <span class="text-xs">
              Create Team
            </span>
          </ActionLink>
        </div>
      </div>
    </template>

    <div class="max-w-7xl mx-auto md:px-3 lg:px-8">
      <div class="py-10">
        <Table
            apiResourceRoute="api.teams.index"
            viewRoute="teams.show"
            viewRouteKeyName="id"
            :headers="{name: 'Name', personal_team: 'Personal Team', created_at: 'Created At'}"
        />
      </div>
    </div>
  </AppLayout>
</template>
