<script setup>
// Core
import {computed, ref} from 'vue';
import {useForm, usePage} from '@inertiajs/inertia-vue3';

// Components
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

// Icons
import FacebookIcon from '@/Components/SocialstreamIcons/FacebookIcon.vue';
import GoogleIcon from '@/Components/SocialstreamIcons/GoogleIcon.vue';
import TwitterIcon from '@/Components/SocialstreamIcons/TwitterIcon.vue';
import LinkedInIcon from '@/Components/SocialstreamIcons/LinkedInIcon.vue';
import GithubIcon from '@/Components/SocialstreamIcons/GithubIcon.vue';
import GitLabIcon from '@/Components/SocialstreamIcons/GitLabIcon.vue';
import BitbucketIcon from '@/Components/SocialstreamIcons/BitbucketIcon.vue';

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
          <TwitterIcon class="h-6 w-6" v-if="provider === 'twitter'"/>
          <TwitterIcon class="h-6 w-6" v-if="provider === 'twitter-oauth-2'"/>
          <LinkedInIcon class="h-6 w-6" v-if="provider === 'linkedin'"/>
          <GithubIcon class="h-6 w-6 dark:text-white" v-if="provider === 'github'"/>
          <GitLabIcon class="h-6 w-6" v-if="provider === 'gitlab'"/>
          <BitbucketIcon class="h-6 w-6" v-if="provider === 'bitbucket'"/>
        </div>

        <div class="text-center sm:text-left mt-3 sm:mt-0">
          <div class="text-sm font-semibold text-slate-900 dark:text-white">
            {{ provider === 'twitter-oauth-2' ? 'Twitter' : provider.charAt(0).toUpperCase() + provider.slice(1) }}
          </div>

          <div v-if="createdAt !== null" class="text-xs text-slate-600 dark:text-slate-400">
            Connected {{ createdAt }}
          </div>

          <div v-else class="text-xs text-slate-500 dark:text-slate-400">
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

          <DangerButton
              @click="$emit('confirmRemoveConnectedAccount')"
              v-if="hasAccountForProvider(provider) && $page.props.socialstream.hasPassword"
              class="text-xs"
          >
            Remove
          </DangerButton>
        </template>

        <template v-else>
          <SecondaryButton @click="push(route('oauth.redirect', { provider }))">
            Connect
          </SecondaryButton>
        </template>
      </div>
    </div>

    <div class="sm:hidden flex flex-col">
      <template v-if="hasAccountForProvider(provider)">
        <SecondaryButton
            v-if="$page.props.jetstream.managesProfilePhotos && hasAccountForProvider(provider) && getAccountForProvider(provider).avatar_path"
            @click="setProfilePhoto(getAccountForProvider(provider).id)"
            class="mt-2"
        >
          Set Profile Photo
        </SecondaryButton>

        <button
            @click="$emit('confirmRemoveConnectedAccount')"
            v-if="hasAccountForProvider(provider) && $page.props.socialstream.hasPassword"
            class="text-xs text-slate-500 mt-2"
        >
          Remove
        </button>
      </template>

      <template v-else>
        <SecondaryButton @click="push(route('oauth.redirect', { provider }))" class="mt-2">
          Connect
        </SecondaryButton>
      </template>
    </div>
  </div>
</template>
