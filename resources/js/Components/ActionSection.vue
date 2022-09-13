<script setup>
import JetSectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="xl:grid xl:grid-cols-3 xl:gap-6">
        <JetSectionTitle>
            <template #title>
                <slot name="title"/>
            </template>
            <template #description>
                <slot name="description"/>
            </template>
        </JetSectionTitle>

        <div class="mt-5 xl:mt-0 xl:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white dark:bg-slate-800 shadow-lg sm:rounded-lg">
                <slot name="content"/>
            </div>
        </div>
    </div>
</template>
