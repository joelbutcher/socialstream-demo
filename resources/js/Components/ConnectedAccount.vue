<script setup>
// Core
import {computed, ref} from 'vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

// Components
import FacebookIcon from '@/Components/SocialstreamIcons/FacebookIcon.vue';
import GoogleIcon from '@/Components/SocialstreamIcons/GoogleIcon.vue';
import MicrosoftIcon from '@/Components/SocialstreamIcons/MicrosoftIcon.vue';
import JetDangerButton from '@/Components/DangerButton.vue';
import JetSecondaryButton from '@/Components/SecondaryButton.vue';

defineEmits(['confirmRemoveConnectedAccount']);

const props = defineProps({
  provider: String,
});

const confirmingRemove = ref(false);

const inertiaProps = usePage().props;

const form = useForm({});

const hasAccountForProvider = (provider) => (
    inertiaProps.value.socialstream.connectedAccounts.filter(
        account => account.provider === provider
    ).length > 0
);

const getAccountForProvider = (provider) => inertiaProps.value.socialstream.connectedAccounts
    .filter(account => account.provider === provider).shift();

const setProfilePhoto = (id) => {
  form.put(route('user-profile-photo.set', {id}), {
    preserveScroll: true
  });
};

const push = (route) => window.location.href = route;

const createdAt = computed(() => hasAccountForProvider(props.provider) ? getAccountForProvider(props.provider).created_at : null);
</script>

<template>
  <div class="px-4 py-6 sm:py-3">
    <div class="flex justify-center sm:justify-between">
      <div class="flex flex-col sm:flex-row items-center justify-center">
        <div class="sm:mr-2">
          <FacebookIcon class="h-6 w-6" v-if="provider === 'facebook'"/>
          <GoogleIcon class="h-6 w-6" v-if="provider === 'google'"/>
          <MicrosoftIcon class="h-6 w-6" v-if="provider === 'microsoft'"/>
        </div>

        <div class="text-center sm:text-left mt-3 sm:mt-0">
          <div class="text-sm font-semibold text-slate-600">
            {{ provider === 'twitter-oauth-2' ? 'Twitter' : provider.charAt(0).toUpperCase() + provider.slice(1) }}
          </div>

          <div v-if="createdAt !== null" class="text-xs text-slate-500">
            Connected {{ createdAt }}
          </div>

          <div v-else class="text-xs text-slate-500">
            Not connected.
          </div>
        </div>
      </div>

      <div class="hidden sm:flex">
        <template v-if="hasAccountForProvider(provider)">
          <button
              v-if="$page.props.jetstream.managesProfilePhotos && hasAccountForProvider(provider) && getAccountForProvider(provider).avatar_path"
              @click="setProfilePhoto(getAccountForProvider(provider).id)"
              class="hidden sm:block text-xs text-slate-700 mr-6"
          >
            Set Profile Photo
          </button>

          <JetDangerButton
              @click="$emit('confirmRemoveConnectedAccount')"
              v-if="hasAccountForProvider(provider) && $page.props.socialstream.hasPassword"
              class="text-xs text-slate-500"
          >
            Remove
          </JetDangerButton>
        </template>

        <template v-else>
          <JetSecondaryButton @click="push(route('oauth.redirect', { provider }))">
            Connect
          </JetSecondaryButton>
        </template>
      </div>
    </div>

    <div class="sm:hidden flex flex-col">
      <template v-if="hasAccountForProvider(provider)">
        <JetSecondaryButton
            v-if="$page.props.jetstream.managesProfilePhotos && hasAccountForProvider(provider) && getAccountForProvider(provider).avatar_path"
            @click="setProfilePhoto(getAccountForProvider(provider).id)"
            class="mt-2"
        >
          Set Profile Photo
        </JetSecondaryButton>

        <button
            @click="$emit('confirmRemoveConnectedAccount')"
            v-if="hasAccountForProvider(provider) && $page.props.socialstream.hasPassword"
            class="text-xs text-slate-500 mt-2"
        >
          Remove
        </button>
      </template>

      <template v-else>
        <JetSecondaryButton @click="push(route('oauth.redirect', { provider }))" class="mt-2">
          Connect
        </JetSecondaryButton>
      </template>
    </div>
  </div>
</template>
