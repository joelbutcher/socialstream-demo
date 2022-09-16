<script setup>
// Core
import {computed} from 'vue';
import {Head, Link, useForm, usePage} from '@inertiajs/inertia-vue3';

// Components
import AuthCard from '@/Components/Auth/Card.vue';
import AuthCardLogo from '@/Components/Auth/CardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Socialstream from '@/Components/Socialstream.vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
});

const socialsteamErrors = computed(() => usePage().props.value.errors.socialstream);

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Register" />

  <AuthCard>
    <template #logo>
      <AuthCardLogo />
    </template>

    <template #header>
      Register
    </template>

    <InputError class="mb-4" :message="socialsteamErrors"/>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="name" value="Name" />
        <TextInput
            id="name"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="name"
        />
        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email" />
        <TextInput
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />
        <TextInput
            id="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="new-password"
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <TextInput
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="mt-1 block w-full"
            required
            autocomplete="new-password"
        />
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
        <InputLabel for="terms">
          <div class="flex items-center">
            <Checkbox id="terms" v-model:checked="form.terms" name="terms" />

            <div class="ml-2">
              I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-slate-600 hover:text-slate-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-slate-600 hover:text-slate-900">Privacy Policy</a>
            </div>
          </div>
        </InputLabel>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link :href="route('login')" class="underline text-sm text-slate-600 hover:text-slate-900">
          Already registered?
        </Link>

        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Register
        </PrimaryButton>
      </div>
    </form>

    <div class="flex flex-row items-center justify-between py-4 text-slate-500 dark:text-slate-400">
      <hr class="w-full mr-2">
      <span class="text-slate-700 dark:text-slate-100">
          Or
        </span>
      <hr class="w-full ml-2">
    </div>

    <Socialstream v-if="$page.props.socialstream.show" />
  </AuthCard>
</template>
