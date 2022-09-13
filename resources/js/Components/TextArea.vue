<script setup>
import { onMounted, ref } from 'vue';

defineProps({
  modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <textarea
      ref="input"
      class="dark:text-slate-200 dark:bg-slate-900 disabled:cursor-not-allowed disabled:opacity-40 disabled:bg-slate-50 dark:disabled:bg-slate-900 border-zinc-300 dark:border-slate-600 focus:border-indigo-200 dark:focus:border-indigo-600 focus:ring focus:ring-gray-200 focus:ring-gray-500 focus:ring-opacity-50 rounded-md shadow-sm"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
