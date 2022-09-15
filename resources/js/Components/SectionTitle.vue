<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 md:px-0">
            <h3 class="text-lg font-medium text-slate-900 dark:text-slate-100 dark:text-slate-100">
                <slot name="title"/>
            </h3>

            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">
                <slot name="description"/>
            </p>
        </div>

        <div class="px-4 md:px-0">
            <slot name="aside"/>
        </div>
    </div>
</template>
