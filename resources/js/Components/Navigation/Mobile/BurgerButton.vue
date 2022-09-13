<script setup>
defineEmits(['toggleMobileMenu']);
</script>

<template>
  <button @click="$emit('toggleMobileMenu')"
          class="p-2 rounded text-slate-500 dark:text-slate-200 bg-white dark:bg-slate-800 hover:text-slate-500 dark:hover:text-slate-300 focus:z-10 focus:outline-none focus:ring ring-slate-300 dark:ring-slate-500 focus:border-blue-300 dark:focus:border-blue-500 active:bg-slate-100 active:text-slate-500 transition ease-in-out duration-200"
  >
    <svg
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg>
  </button>
</template>
