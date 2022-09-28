<script setup>
// Core
import {computed, ref} from 'vue';
import {Head, Link, useForm, usePage} from '@inertiajs/inertia-vue3';

// Components
import AuthCard from '@/Components/Auth/Card.vue';
import AuthCardLogo from '@/Components/Auth/CardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Socialstream from '@/Components/Socialstream.vue';

const signInWithEmail = ref(false);

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
});

const socialsteamErrors = computed(() => usePage().props.value.errors.socialstream);

const toggleSignInWith = () => {
  signInWithEmail.value = !signInWithEmail.value;
};

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Register"/>

  <AuthCard>
    <template #logo>
      <AuthCardLogo/>
    </template>

    <template #header>
      <div class="flex items-center justify-between">
        Register

        <template v-if="signInWithEmail">
          <button
              @click="toggleSignInWith"
              role="button"
              class="text-sm font-normal text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200 underline underline-offset-2 transition-all duration-200"
          >
            Use SSO
          </button>
        </template>
      </div>

      <div class="text-lg font-semibold text-primary-500 dark:text-primary-400 tracking-wide mt-2">
        Create your Account
      </div>
    </template>

    <template v-if="signInWithEmail">
      <form @submit.prevent="submit">
        <div>
          <InputLabel for="name" value="Name"/>
          <TextInput
              id="name"
              v-model="form.name"
              type="text"
              class="mt-1 block w-full"
              required
              autofocus
              autocomplete="name"
          />
          <InputError class="mt-2" :message="form.errors.name"/>
        </div>

        <div class="mt-4">
          <InputLabel for="email" value="Email"/>
          <TextInput
              id="email"
              v-model="form.email"
              type="email"
              class="mt-1 block w-full"
              required
          />
          <InputError class="mt-2" :message="form.errors.email"/>
        </div>

        <div class="mt-4">
          <InputLabel for="password" value="Password"/>
          <TextInput
              id="password"
              v-model="form.password"
              type="password"
              class="mt-1 block w-full"
              required
              autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password"/>
        </div>

        <div class="mt-4">
          <InputLabel for="password_confirmation" value="Confirm Password"/>
          <TextInput
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              class="mt-1 block w-full"
              required
              autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password_confirmation"/>
        </div>

        <div class="flex items-center justify-end mt-4">
          <Link :href="route('login')" class="underline text-sm text-slate-600 hover:text-slate-900">
            Already registered?
          </Link>

          <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Register
          </PrimaryButton>
        </div>
      </form>
    </template>

    <template v-else>
      <InputError class="mb-4" :message="socialsteamErrors"/>

      <Socialstream v-if="$page.props.socialstream.show"/>

      <div class="flex">
        <button
            @click="toggleSignInWith"
            role="button"
            class="w-full text-sm rounded-full bg-white text-slate-900 hover:text-black border border-slate-500 hover:border-slate-700 py-3 px-4 mt-3 transition duration-200"
        >
          Register with email
        </button>
      </div>

      <div class="flex items-center justify-center">
        <Link
            :href="route('login')"
            class="text-sm font-normal text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200 underline underline-offset-2 mt-4 transition-all duration-200"
        >
          Already Registered?
        </Link>
      </div>
    </template>


    <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
      <div class="text-xs dark:text-white mt-10 text-center">
        By registering, you agree to the
        <Link
            target="_blank"
            :href="route('terms.show')"
            class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200 underline underline-offset-2 transition-all duration-200"
        >
          Terms of Service
        </Link>
        and
        <Link
            target="_blank"
            :href="route('policy.show')"
            class="text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200 underline underline-offset-2 transition-all duration-200"
        >
          Privacy Policy
        </Link>
      </div>
    </div>
  </AuthCard>
</template>
