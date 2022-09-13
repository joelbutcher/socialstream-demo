<script setup>
// Core
import clsx from 'clsx';
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
  href: String,
  active: Boolean,
  collapsed: {
    type: Boolean,
    default: false,
  },
});

const classes = computed(() => clsx(
    'flex w-full items-center justify-start text-slate-700 dark:text-slate-300 space-x-4 border-l-2 text-xs sm:text-sm px-4 sm:px-6 py-3 transition duration-250',
    props.active ? 'bg-slate-50 dark:bg-slate-900 border-indigo-500' : 'hover:bg-slate-50 dark:hover:bg-slate-900 border-transparent'
));
</script>

<template>
  <div :class="clsx('flex w-full items-center', collapsed ? 'justify-center' : 'justify-start')">
    <Link :href="href" :class="classes">
      <slot/>
    </Link>
  </div>
</template>
