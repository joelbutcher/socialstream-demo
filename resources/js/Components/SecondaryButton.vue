<script setup>
defineProps({
  type: {
    type: String,
    default: 'button',
  },
});
</script>

<template>
  <button :type="type" class="inline-flex items-center px-4 py-2 dark:text-slate-200 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-md font-semibold text-xs text-slate-500 uppercase tracking-widest shadow-sm hover:text-slate-700 dark:hover:text-white border border-500 hover:border-slate-700 dark:hover:border-slate-200 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-slate-800 active:bg-gray-50 disabled:opacity-25 transition duration-300">
    <slot />
  </button>
</template>
