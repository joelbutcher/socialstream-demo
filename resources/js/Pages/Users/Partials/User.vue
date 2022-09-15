<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
  user: {
    type: Object,
    validator: (o) => (
        o.hasOwnProperty('id') &&
        o.hasOwnProperty('name') &&
        o.hasOwnProperty('email') &&
        o.hasOwnProperty('profile_photo_url') &&
        o.hasOwnProperty('created_at')
    ),
  }
});
</script>

<template>
  <Link :href="route('users.show', user.email)">
    <div class="py-4">
      <div class="flex items-center justify-between px-4">
        <div class="flex items-center">
          <div class="shrink-0 mr-3">
            <img class="h-10 w-10 rounded-full object-cover" :src="user.profile_photo_url"
                 :alt="user.profile_photo_url">
          </div>

          <div>
            <div class="font-medium text-base text-slate-800 dark:text-slate-100">
              {{ user.name }}
            </div>
            <p class="font-medium text-sm text-slate-500 dark:text-slate-400 truncate">
              {{ user.email }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </Link>
</template>
