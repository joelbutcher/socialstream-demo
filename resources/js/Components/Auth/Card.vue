<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-900">
    <div>
      <slot name="logo"/>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 bg-white dark:bg-slate-800 shadow-md overflow-hidden sm:rounded-xl py-6">
      <h2 class="font-bold text-2xl text-slate-700 dark:text-white leading-tight">
        <slot name="header" />
      </h2>

      <div class="mt-10">
        <slot />
      </div>
    </div>
  </div>
</template>
