<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';
import {UserPlusIcon} from '@heroicons/vue/24/outline';

// Layout
import AppLayout from '@/Layouts/AppLayout.vue';

// Components
import Table from '@/Components/Table.vue';
import ActionLink from '@/Components/ActionLink.vue';
</script>

<template>
  <AppLayout title="Users">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <div class="flex items-center justify-between">
          <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            Users
          </h2>

          <ActionLink :href="route('users.create')" class="py-1.5 px-2.5">
            <UserPlusIcon class="w-6 h-6"/>
          </ActionLink>
        </div>
      </div>
    </template>

    <div class="max-w-7xl mx-auto md:px-3 lg:px-8">
      <div class="py-6">
        <Table
            apiResourceRoute="api.users.index"
            viewRoute="users.show"
            viewRouteKeyName="email"
            :headers="{name: 'Name', email: 'Email', created_at: 'Created At'}"
        />
      </div>
    </div>
  </AppLayout>
</template>
