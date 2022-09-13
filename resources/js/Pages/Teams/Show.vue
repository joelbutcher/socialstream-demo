<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';

// Layout
import AppLayout from '@/Layouts/AppLayout.vue';

// Partials
import UpdateTeamNameForm from '@/Pages/Teams/Partials/UpdateTeamNameForm.vue';
import TeamMemberManager from '@/Pages/Teams/Partials/TeamMemberManager.vue';
import DeleteTeamForm from '@/Pages/Teams/Partials/DeleteTeamForm.vue';

// Components
import JetSectionBorder from '@/Components/SectionBorder.vue';

defineProps({
  team: Object,
  availableRoles: Array,
  permissions: Object,
});
</script>

<template>
  <AppLayout title="Team Settings">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="text-xs text-blue-600 dark:text-blue-400">
          <Link :href="route('teams.index')" class="hover:underline">Team Settings</Link>
          <span class="text-slate-500 dark:text-slate-300">
            / {{ team.name }}</span>
        </div>
      </div>
    </template>

    <div class="max-w-7xl mx-auto md:px-3 lg:px-8">
      <div class="flex items-center justify-between py-6 border-b border-slate-300 dark:border-slate-600">
        <h2 class="font-bold text-lg sm:text-2xl text-slate-900 dark:text-slate-100">
          {{ team.name }}
        </h2>
      </div>

      <div class="py-6 sm:px-6 lg:px-8">
        <UpdateTeamNameForm :team="team" :permissions="permissions"/>

        <TeamMemberManager
            class="mt-10 sm:mt-0"
            :team="team"
            :available-roles="availableRoles"
            :user-permissions="permissions"
        />

        <template v-if="permissions.canDeleteTeam && ! team.personal_team">
          <JetSectionBorder/>

          <DeleteTeamForm class="mt-10 sm:mt-0" :team="team"/>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
