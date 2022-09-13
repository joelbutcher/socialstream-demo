<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetSectionBorder from '@/Components/SectionBorder.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import SetPasswordForm from '@/Pages/Profile/Partials/SetPasswordForm.vue';
import ConnectedAccountsForm from '@/Pages/Profile/Partials/ConnectedAccountsForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
  confirmsTwoFactorAuthentication: Boolean,
  sessions: Array,
});
</script>

<template>
  <AppLayout title="Profile">
    <template #header>
      <div class="max-w-7xl mx-auto pt-10 px-4 lg:px-8">
        <h2 class="font-bold text-xl md:text-2xl text-slate-800 dark:text-slate-200 leading-tight mt-2">
          Profile
        </h2>
      </div>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
        <UpdateProfileInformationForm :user="$page.props.user"/>

        <JetSectionBorder/>

        <UpdatePasswordForm class="mt-10 sm:mt-0"/>

        <JetSectionBorder/>

        <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0"/>
      </div>
    </div>
  </AppLayout>
</template>
