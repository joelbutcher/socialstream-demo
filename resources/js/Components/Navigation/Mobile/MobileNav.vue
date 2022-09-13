<script setup>
// Core
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import {
  HomeIcon,
  ChevronRightIcon,
  ArrowLeftOnRectangleIcon,
} from '@heroicons/vue/24/solid';

// Components
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import MobileNavLink from '@/Components/Navigation/Mobile/MobileNavLink.vue';

defineEmits(['toggleMobileMenu']);

defineProps({
  mobileMenuOpen: Boolean,
});

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

      <!-- Profile -->
      <Link
          :href="route('profile.show')"
          class="my-3 py-3"
      >
        <div
             class="flex items-center justify-between text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 pl-4 pr-6 sm:px-6"
        >
          <div class="flex items-center space-x-4">
            <img
                class="h-8 w-8 rounded-full object-cover"
                :src="$page.props.user.profile_photo_url"
                :alt="$page.props.user.full_name"
            >

            <div class="flex flex-col items-start">
              <div class="text-sm sm:text-base font-bold tracking-wider">
                {{ $page.props.user.full_name }}
              </div>

              <div class="text-xs sm:text-sm text-slate-500 dark:text-slate-300 font-semibold tracking-wider">
                {{ $page.props.user.email }}
              </div>
            </div>
          </div>

          <ChevronRightIcon
              class="w-5 h-5"
              v-if="! route().current('profile.show')"
          />
        </div>
      </Link>

      <!-- Main Menu -->
      <div class="flex flex-col grow py-2 border-t border-indigo-500 overflow-scroll shadow-inner">
        <div class="px-4 py-1 text-xs sm:text-sm text-slate-700 dark:text-slate-300 font-semibold tracking-wider">
          Main Menu
        </div>

        <MobileNavLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
          <HomeIcon class="w-4 h-4"/>
          <span class="text-xs sm:text-sm">Home</span>
        </MobileNavLink>
      </div>

      <!-- Account Management -->
      <div class="border-t border-indigo-500 py-2">
        <div class="px-4 py-1 text-xs sm:text-sm text-slate-700 dark:text-slate-300 font-semibold tracking-wider">
          Account Management
        </div>
      </div>

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
