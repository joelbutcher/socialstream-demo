<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-900">
    <div>
      <slot name="logo"/>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-slate-800 shadow-md overflow-hidden sm:rounded-lg">
      <h2 class="font-bold text-xl lg:text-2xl text-slate-700 dark:text-slate-300 leading-tight mt-4 ml-2">
        <slot name="header" />
      </h2>

      <div class="mt-4 lg:mt-8">
        <slot />
      </div>
    </div>
  </div>
</template>
