<script setup>
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
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
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-white dark:bg-slate-800 sm:p-6 shadow-lg"
                    :class="hasActions ? 'md:rounded-tl-md md:rounded-tr-md' : 'md:rounded-md'"
                >
                    <div class="grid grid-cols-6 gap-4">
                        <slot name="form"/>
                    </div>
                </div>

                <div v-if="hasActions" class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-slate-900/25 text-right sm:px-6 shadow-lg md:rounded-bl-md md:rounded-br-md">
                    <slot name="actions"/>
                </div>
            </form>
        </div>
    </div>
</template>
