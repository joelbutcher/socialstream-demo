<script setup>
import AppleIcon from '@/Components/SocialstreamIcons/AppleIcon.vue';
import BitbucketIcon from '@/Components/SocialstreamIcons/BitbucketIcon.vue';
import FacebookIcon from '@/Components/SocialstreamIcons/FacebookIcon.vue';
import GithubIcon from '@/Components/SocialstreamIcons/GithubIcon.vue';
import GitLabIcon from '@/Components/SocialstreamIcons/GitLabIcon.vue';
import GoogleIcon from '@/Components/SocialstreamIcons/GoogleIcon.vue';
import LinkedInIcon from '@/Components/SocialstreamIcons/LinkedInIcon.vue';
import SlackIcon from '@/Components/SocialstreamIcons/SlackIcon.vue';
import TwitterIcon from '@/Components/SocialstreamIcons/TwitterIcon.vue';

defineProps({
   provider: {
      type: Object
   },
   classes: {
      type: String,
   }
});
</script>

<template>
   <div>
      <AppleIcon v-if="provider.id === 'apple'" :class="classes"/>
      <BitbucketIcon v-else-if="provider.id === 'bitbucket'" :class="classes"/>
      <FacebookIcon v-else-if="provider.id === 'facebook'" :class="classes"/>
      <GithubIcon v-else-if="provider.id === 'github'" :class="classes"/>
      <GitLabIcon v-else-if="provider.id === 'gitlab'" :class="classes"/>
      <GoogleIcon v-else-if="provider.id === 'google'" :class="classes"/>
      <LinkedInIcon v-else-if="provider.id === 'linkedin' || provider.id === 'linkedin-openid'" :class="classes"/>
      <SlackIcon v-else-if="provider.id === 'slack'" :class="classes"/>
      <TwitterIcon v-else-if="provider.id === 'twitter' || provider.id === 'twitter-oauth-2'" :class="classes"/>
   </div>
</template>
