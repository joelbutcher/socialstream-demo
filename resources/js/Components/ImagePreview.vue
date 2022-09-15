<script setup>
defineProps({
  file: { type: Object, required: true },
  as: { type: String, default: 'li' },
})
</script>

<template>
  <component :is="as" class="file-preview">
    <div class="col-span-1">
      <span
        :style="'background-image: url(\'' + file.data + '\');'"
        class="block h-20 w-20 bg-contain bg-no-repeat bg-center bg-slate-100 bg-slate-800"
      />
    </div>
  </component>
</template>

