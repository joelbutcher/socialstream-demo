<script setup>
// Components
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  title: String,
});
</script>

<template>
  <AppLayout :title="title">
    <template #header>
      <div class="flex items-center justify-between">
        <slot name="header"/>
      </div>
    </template>

    <slot/>
  </AppLayout>
</template>
