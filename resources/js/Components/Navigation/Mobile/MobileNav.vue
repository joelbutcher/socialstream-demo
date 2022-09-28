<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';
import {
  HomeIcon,
  UserIcon,
  UsersIcon,
  UserGroupIcon,
  CodeBracketIcon,
  ArrowLeftOnRectangleIcon,
} from '@heroicons/vue/24/solid';

// Components
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import MobileNavLink from '@/Components/Navigation/Mobile/MobileNavLink.vue';

defineEmits(['toggleMobileMenu']);

defineProps({
  mobileMenuOpen: Boolean,
});

const switchToTeam = (team) => {
  Inertia.put(route('current-team.update'), {
    team_id: team.id,
  }, {
    preserveState: false,
  });
};

const logout = () => {
  Inertia.post(route('logout'));
};
</script>
<template>
  <!-- Mobile Navigation -->
  <Transition
      enter-active-class="duration-300 ease-out"
      enter-from-class="-translate-x-full"
      leave-active-class="duration-200 ease-in"
      leave-to-class="-translate-x-full"
  >
    <nav v-show="mobileMenuOpen" class="absolute inset-0 flex flex-col bg-white dark:bg-slate-800 z-50">
      <div class="flex items-center justify-between py-6 px-4 sm:px-6">
        <!-- Logo -->
        <Link :href="route('dashboard')">
          <ApplicationLogo class="block h-9 w-auto text-white"/>
        </Link>

        <button @click="$emit('toggleMobileMenu')"
                class="p-2 rounded text-slate-500 dark:text-slate-200 bg-white dark:bg-slate-800 hover:text-slate-500 dark:hover:text-slate-300 focus:z-10 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 active:text-slate-500 transition ease-in-out duration-200"
        >
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15"/>
          </svg>
        </button>
      </div>

      <!-- Main Menu -->
      <div class="flex flex-col py-2 border-t border-indigo-500 overflow-scroll shadow-inner">
        <div class="px-4 py-1 text-xs text-slate-700 dark:text-slate-300 font-semibold tracking-wider">
          Main Menu
        </div>

        <ul>

          <MobileNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
          >
            <HomeIcon class="w-4 h-4"/>
            <span class="text-xs sm:text-sm">Home</span>
          </MobileNavLink>
        </ul>
      </div>

      <!-- Account Management -->
      <div class="grow border-t border-indigo-500 py-2">
        <MobileNavLink
            :href="route('profile.show')"
            :active="route().current('profile.show')"
        >
          <UserIcon class="w-4 h-4"/>
          <span class="text-xs sm:text-sm">
            Profile
          </span>
        </MobileNavLink>

        <MobileNavLink
            :href="route('api-tokens.index')"
            :active="route().current('api-tokens.index')"
            v-show="$page.props.jetstream.hasApiFeatures"
        >
          <CodeBracketIcon class="w-4 h-4"/>
          <span class="text-xs sm:text-sm">
            API Tokens
          </span>
        </MobileNavLink>
      </div>

      <!-- Team Management -->
      <template v-if="$page.props.jetstream.hasTeamFeatures">
        <div class="border-t border-indigo-500 py-2">
          <div class="px-4 py-1 text-xs text-slate-700 dark:text-slate-300 font-semibold tracking-wider">
            Manage Team
          </div>

          <MobileNavLink
              :href="route('teams.show', $page.props.user.current_team)"
              :active="route().current('teams.show')"
          >
            <span class="text-xs sm:text-sm">
              Team Settings
            </span>
          </MobileNavLink>

          <MobileNavLink
              :href="route('teams.create')"
              v-if="$page.props.jetstream.canCreateTeams"
              :active="route().current('teams.create')"
          >
            <span class="text-xs sm:text-sm">
              Create new Settings
            </span>
          </MobileNavLink>
        </div>

        <div class="border-t border-indigo-500 py-2">
          <div class="px-4 py-1 text-xs text-slate-700 dark:text-slate-300 font-semibold tracking-wider">
            Switch Teams
          </div>

          <template v-for="team in $page.props.user.all_teams" :key="team.id">
            <form @submit.prevent="switchToTeam(team)">
              <MobileNavLink
                  as="button"
              >
                <div class="flex items-center">
                  <svg
                      v-if="team.id === $page.props.user.current_team_id"
                      class="mr-2 h-5 w-5 text-green-400"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                  >
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <div>
                    {{ team.name }}
                  </div>
                </div>
              </MobileNavLink>
            </form>
          </template>
        </div>
      </template>

      <div class="border-t border-indigo-500 mb-2">
        <button @click="logout"
                class="flex w-full items-center justify-start text-sm text-red-500 space-x-4 px-6 py-3 transition duration-250">
          <ArrowLeftOnRectangleIcon class="w-4 h-4"/>
          <span class="text-xs sm:text-sm">Logout</span>
        </button>
      </div>

    </nav>
  </Transition>
</template>
