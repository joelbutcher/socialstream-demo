<script setup>
import clsx from 'clsx';
import {Link} from '@inertiajs/inertia-vue3';

const props = defineProps({
  href: {
    type: String,
    default: '#',
  },
  label: String,
  active: Boolean,
  open: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <li
      :class="clsx(
          'relative cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-900 border-l-4 border-transparent group list-none',
          'transition duration-300 ease',
          active && 'bg-slate-100 dark:bg-slate-900 border-indigo-500',
      )"
  >
    <Link
        :href="href"
        :class="clsx(
            'flex h-100 w-100 text-slate-700 dark:text-slate-300 items-center transition-all duration-400 ease px-6 py-3',
        )"
    >
      <i>
        <slot name="icon"/>
      </i>
      <span
          :class="clsx(
              'text-sm ml-4 transition duration-400 opacity-0 pointer-events-none whitespace-nowrap',
              open && 'block opacity-100',
          )"
      >
        {{ label }}
      </span>
    </Link>
    <span
        v-show="!open"
        :class="clsx(
          'absolute left-full top-0 bottom-0',
          'pointer-events-none group-hover:opacity-100',
          'transition-opacity duration-200 ease-in',
          'bg-white dark:bg-slate-900 text-sm',
          'whitespace-nowrap',
          'rounded-xl shadow-lg',
          'py-3 px-4 ml-2',
          'opacity-0',
          'text-sm',
        )">
      {{ label }}
    </span>
  </li>
</template>
