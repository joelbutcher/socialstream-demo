<script setup>
// Core
import clsx from 'clsx';
import { Inertia } from '@inertiajs/inertia';
import { ArrowLeftOnRectangleIcon } from '@heroicons/vue/24/outline';

defineProps({
  open: Boolean,
});

const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <li
      :class="clsx(
            'relative cursor-pointer hover:bg-gray-200 dark:hover:bg-slate-900 border-l-4 border-transparent group',
            'list-none px-6 py-3',
        )"
  >
    <button
        @click="logout"
        :class="clsx(
              'flex h-100 w-100 items-center text-red-500 transition-all duration-400 ease',
          )"
    >
      <i>
        <ArrowLeftOnRectangleIcon class="w-5 h-5 text-red-500"/>
      </i>
      <span
          :class="clsx(
                'text-base font-semibold ml-4 transition duration-400 opacity-0 pointer-events-none whitespace-nowrap',
                open && 'block opacity-100',
            )"
      >
              Logout
            </span>
    </button>
  </li>
</template>
