<script setup>
// Core
import {PlusCircleIcon} from '@heroicons/vue/24/outline';

// Layout
import AppLayout from '@/Layouts/AppLayout.vue';

// Components
import Table from '@/Components/Table.vue';
import ActionLink from '@/Components/ActionLink.vue';
import MobileTeamListItem from '@/Pages/Teams/Partials/MobileTeamListItem.vue';

</script>

<template>
  <AppLayout title="My Teams">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="text-xs">
          Teams /
        </div>

        <div class="flex items-center justify-between mt-2">
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
            v-slot="slotProps"
            apiResourceRoute="api.teams.index"
            viewRoute="teams.show"
            viewRouteKeyName="id"
            :headers="{name: 'Name', personal_team: 'Personal Team', created_at: 'Created At'}"
        >
          <div class="bg-white dark:bg-slate-800 shadow">
            <template v-for="team in slotProps.items">
              <MobileTeamListItem :team="team"/>
            </template>
          </div>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
