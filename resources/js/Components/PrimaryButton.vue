<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-zinc-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot/>
    </button>
</template>
