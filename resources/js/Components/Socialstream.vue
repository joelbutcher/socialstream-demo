<script setup>
// Core
import {computed} from 'vue';
import {usePage} from '@inertiajs/inertia-vue3';

// Icons
import FacebookIcon from '@/Components/SocialstreamIcons/FacebookIcon.vue';
import GoogleIcon from '@/Components/SocialstreamIcons/GoogleIcon.vue';
import TwitterIcon from '@/Components/SocialstreamIcons/TwitterIcon.vue';
import LinkedInIcon from '@/Components/SocialstreamIcons/LinkedInIcon.vue';
import GithubIcon from '@/Components/SocialstreamIcons/GithubIcon.vue';
import GitLabIcon from '@/Components/SocialstreamIcons/GitLabIcon.vue';
import BitbucketIcon from '@/Components/SocialstreamIcons/BitbucketIcon.vue';

const error = computed(() => usePage().props.value.errors.socialstream);
</script>

<template>
  <div class="grid gap-3">
    <a
        v-if="$page.props.socialstream.providers.includes('facebook')"
        :href="route('oauth.redirect', 'facebook')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <FacebookIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with Facebook
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('google')"
        :href="route('oauth.redirect', 'google')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <GoogleIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with Google
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('twitter')"
        :href="route('oauth.redirect', 'twitter')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <TwitterIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with Twitter
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('twitter-oauth-2')"
        :href="route('oauth.redirect', 'twitter-oauth-2')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <TwitterIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with Twitter
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('linkedin')"
        :href="route('oauth.redirect', 'linkedin')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <LinkedInIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with LinkedIn
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('github')"
        :href="route('oauth.redirect', 'github')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <GithubIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with GitHub
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('gitlab')"
        :href="route('oauth.redirect', 'gitlab')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <GitLabIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with GitLab
        </span>
    </a>

    <a
        v-if="$page.props.socialstream.providers.includes('bitbucket')"
        :href="route('oauth.redirect', 'bitbucket')"
        class="w-full flex items-center justify-center rounded-full text-slate-700 dark:text-slate-200 border-2 border-zinc-300 hover:border-indigo-500 py-3 transition duration-200"
    >
      <BitbucketIcon class="h-6 w-6 mx-2"/>
      <span class="sr:hidden text-sm font-semibold">
          Login with BitBucket
        </span>
    </a>
  </div>
</template>
