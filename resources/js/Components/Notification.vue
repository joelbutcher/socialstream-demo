<script setup>
import {computed, ref, watch} from 'vue';
import {usePage} from '@inertiajs/inertia-vue3';
import { TransitionRoot } from '@headlessui/vue';

const show = ref(true);
const style = computed(() => usePage().props.value.jetstream.flash?.bannerStyle || 'success');
const message = computed(() => usePage().props.value.jetstream.flash?.banner || '');

watch(message, async () => {
  show.value = true;
});

setTimeout(() => {
  show.value = false;
}, 2000);
</script>

<template>
  <div class="absolute bottom-6 right-8 w-full max-w-sm rounded-lg shadow-xl overflow-hidden">
    <TransitionRoot
        :show="show"
        enter="transition-opacity duration-[750ms]"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-150"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
      <div v-if="message" :class="{ 'bg-indigo-500': style == 'success', 'bg-gray-700': style == 'danger' }">
        <div class="py-2 px-3 sm:px-6">
          <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
              <span class="flex p-2 rounded-lg"
                    :class="{ 'bg-indigo-600': style == 'success', 'bg-gray-600': style == 'danger' }">
                <svg
                    v-if="style == 'success'"
                    class="h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>

                <svg
                    v-if="style == 'danger'"
                    class="h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                  />
                </svg>
              </span>

              <p class="ml-3 font-medium text-sm text-white truncate">
                {{ message }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </TransitionRoot>
  </div>
</template>
