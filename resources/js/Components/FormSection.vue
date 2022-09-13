<script setup>
import { computed, useSlots } from 'vue';
import JetSectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
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
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-white dark:bg-slate-800 sm:p-6 shadow-lg"
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                >
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form"/>
                    </div>
                </div>

                <div v-if="hasActions" class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-slate-900/25 text-right sm:px-6 shadow-lg sm:rounded-bl-md sm:rounded-br-md">
                    <slot name="actions"/>
                </div>
            </form>
        </div>
    </div>
</template>
