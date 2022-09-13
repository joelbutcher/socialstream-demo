<script setup>
import FacebookIcon from '@/Components/SocialstreamIcons/FacebookIcon.vue';
import GoogleIcon from '@/Components/SocialstreamIcons/GoogleIcon.vue';
import MicrosoftIcon from '@/Components/SocialstreamIcons/MicrosoftIcon.vue';
</script>

<template>
  <div>
    <div class="flex flex-col items-center justify-center space-y-4 lg:px-8">
      <a
          v-if="$page.props.socialstream.providers.includes('google')"
          :href="route('oauth.redirect', 'google')"
          class="w-full flex items-center justify-center rounded-full border-2 border-zinc-300 hover:border-indigo-500 py-3 transition"
      >
        <GoogleIcon class="h-6 w-6 mx-2"/>
        <span class="sr:hidden text-sm font-semibold text-slate-700">
          Login with Google
        </span>
      </a>

      <a
          v-if="$page.props.socialstream.providers.includes('microsoft')"
          :href="route('oauth.redirect', 'microsoft')"
          class="w-full flex items-center justify-center rounded-full border-2 border-zinc-300 hover:border-indigo-500 py-3 transition"
      >
        <MicrosoftIcon class="h-6 w-6 mx-2"/>
        <span class="sr:hidden text-sm font-semibold text-slate-700">
          Login with Microsoft
        </span>
      </a>

      <a
          v-if="$page.props.socialstream.providers.includes('facebook')"
          :href="route('oauth.redirect', 'facebook')"
          class="w-full flex items-center justify-center rounded-full border-2 border-zinc-300 hover:border-indigo-500 py-3 transition"
      >
        <FacebookIcon class="h-6 w-6 mx-2"/>
        <span class="sr:hidden text-sm font-semibold text-slate-700">
          Login with Facebook
        </span>
      </a>
    </div>
  </div>
</template>
