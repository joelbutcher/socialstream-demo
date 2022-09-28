<script setup>
import SectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="lg:grid lg:grid-cols-3 lg:gap-4">
        <SectionTitle>
            <template #title>
                <slot name="title"/>
            </template>
            <template #description>
                <slot name="description"/>
            </template>
        </SectionTitle>

        <div class="mt-5 lg:mt-0 lg:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white dark:bg-slate-800 shadow-lg md:rounded-lg">
                <slot name="content"/>
            </div>
        </div>
    </div>
</template>
