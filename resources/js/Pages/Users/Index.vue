<script setup>
// Core
import {Link} from '@inertiajs/inertia-vue3';
import {PlusCircleIcon} from '@heroicons/vue/24/outline';

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
        <div class="mt-2 text-xs">
          Users /
        </div>

        <div class="flex items-center justify-between mt-2">
          <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            Users
          </h2>

          <ActionLink :href="route('users.create')">
            <PlusCircleIcon class="w-6 h-6 mr-2"/>
            <span class="text-xs">
              Create User
            </span>
          </ActionLink>
        </div>
      </div>
    </template>

    <div class="max-w-7xl mx-auto md:px-3 lg:px-8">
      <div class="py-10">
        <Table
            apiResourceRoute="api.users.index"
            viewRoute="users.show"
            viewRouteKeyName="email"
            :headers="{full_name: 'Name', email: 'Email', created_at: 'Created At'}"
        />
      </div>
    </div>
  </AppLayout>
</template>
