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
import SectionBorder from '@/Components/SectionBorder.vue';

defineProps({
  team: Object,
  availableRoles: Array,
  permissions: Object,
});
</script>

<template>
  <AppLayout title="Team Settings">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-3 lg:px-8">
        <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
          {{ team.name }}
        </h2>
      </div>
    </template>

    <div class="max-w-7xl mx-auto md:px-3 lg:px-8">
      <div class="py-6">
        <UpdateTeamNameForm :team="team" :permissions="permissions"/>

        <TeamMemberManager
            class="mt-10 sm:mt-0"
            :team="team"
            :available-roles="availableRoles"
            :user-permissions="permissions"
        />

        <template v-if="permissions.canDeleteTeam && ! team.personal_team">
          <SectionBorder/>

          <DeleteTeamForm class="mt-10 sm:mt-0" :team="team"/>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
