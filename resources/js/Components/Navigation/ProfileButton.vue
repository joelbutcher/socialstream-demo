<script setup>
// Core
import {
  UserIcon,
  CodeBracketIcon,
  ArrowLeftOnRectangleIcon,
} from '@heroicons/vue/24/solid';

// Components
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import {Inertia} from '@inertiajs/inertia';

const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <div class="hidden md:flex ml-3 relative">
    <Dropdown width="48">
      <template #trigger>
        <button
            class="flex text-sm border-2 border-transparent rounded-full transition-shadow duration-250 focus:outline-none focus:border-zinc-300 transition">
          <img
              class="h-8 w-8 rounded-full object-cover"
              :src="$page.props.user.profile_photo_url"
              :alt="$page.props.user.full_name"
          >
        </button>
      </template>

      <template #content>
        <!-- Account Management -->
        <div class="block px-4 py-2 text-xs text-slate-400">
          Manage Account
        </div>

        <DropdownLink
            :href="route('profile.show')"
            :active="route().current('profile.show')"
        >
          <UserIcon class="mr-2 w-5 h-5" />
          Profile
        </DropdownLink>

        <DropdownLink
            v-if="$page.props.jetstream.hasApiFeatures"
            :href="route('api-tokens.index')"
            :active="route().current('api-tokens.index')"
        >
          <CodeBracketIcon class="mr-2 w-5 h-5" />
          API Tokens
        </DropdownLink>

        <div class="py-2">
          <div class="border-t border-slate-100 dark:border-slate-700" />
        </div>

        <!-- Authentication -->
        <form @submit.prevent="logout">
          <DropdownLink as="button">
            <ArrowLeftOnRectangleIcon class="mr-2 w-5 h-5" />
            Log Out
          </DropdownLink>
        </form>
      </template>
    </Dropdown>
  </div>
</template>
