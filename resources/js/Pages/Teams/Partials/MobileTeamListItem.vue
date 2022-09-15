<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';
import {ChevronRightIcon} from '@heroicons/vue/24/outline';

defineProps({
  team: Object,
});
</script>

<template>
  <Link :href="route('teams.show', team.id)">
    <div class="py-4">
      <div class="flex items-center justify-between px-4">
        <div class="flex items-center">
          <div>
            <div class="font-bold text-base text-slate-800 dark:text-slate-100">
              {{ team.name }}
              <span v-if="team.personal_team" class="font-medium text-sm italic ml-0.5 text-slate-600">
                (Personal)
              </span>
            </div>
            <p class="font-semibold text-xs italic mt-2">
              Created {{ team.created_at }}
            </p>
          </div>
        </div>

        <div class="flex items-center">
          <ChevronRightIcon class="w-5 h-5"/>
        </div>
      </div>
    </div>
  </Link>
</template>
