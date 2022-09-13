<script setup>
// Core
import { ref } from 'vue';
import { UserIcon, CogIcon } from '@heroicons/vue/24/solid';

// Components
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showingDropdown = ref(false);
</script>

<template>
  <div class="hidden md:flex ml-3 relative">
    <Dropdown width="48">
      <template #trigger>
        <button  class="flex text-sm border-2 border-transparent rounded-full transition-shadow duration-250 focus:outline-none focus:border-zinc-300 transition">
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

        <DropdownLink :href="route('profile.show')" :active="route().current('profile.show')">
          <UserIcon class="mr-2 w-5 h-5" />
          Profile
        </DropdownLink>
      </template>
    </Dropdown>
  </div>
</template>
