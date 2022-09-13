<script setup>
// Core
import clsx from 'clsx';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  href: String,
  as: String,
  active: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <div>
    <button v-if="as == 'button'" type="submit"
            class="flex items-center w-full px-4 py-2 text-sm leading-5 border-l-2 border-transparent text-slate-700 text-left dark:text-slate-200 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 transition">
      <slot/>
    </button>

    <a v-else-if="as =='a'" :href="href"
       :class="clsx(
               'flex items-center px-4 py-2 text-sm leading-5 border-l-2 text-slate-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 transition',
              active ? 'border-indigo-500' : 'border-transparent'
           )"
    >
      <slot/>
    </a>

    <Link v-else :href="href"
          :class="clsx(
               'flex items-center px-4 py-2 text-sm leading-5 border-l-2 text-slate-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 transition',
              active ? 'border-indigo-500' : 'border-transparent'

           )">
      <slot/>
    </Link>
  </div>
</template>
