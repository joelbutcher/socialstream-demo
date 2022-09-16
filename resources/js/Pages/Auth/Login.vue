<script setup>
// Core
import {computed} from 'vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';

// Components
import AuthCard from '@/Components/Auth/Card.vue';
import AuthCardLogo from '@/Components/Auth/CardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Socialstream from '@/Components/Socialstream.vue';

defineProps({
  status: String,
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const socialsteamErrors = computed(() => usePage().props.value.errors.socialstream);

const submit = () => {
  form.transform(data => ({
    ...data,
    remember: form.remember ? 'on' : '',
  })).post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <Head title="Log in"/>

  <AuthCard>
    <template #logo>
      <AuthCardLogo/>
    </template>

    <template #header>
      Login to Your Account
    </template>

    <InputError class="mb-4" :message="socialsteamErrors"/>

    <div>
      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="email" value="Email"/>
          <TextInput
              id="email"
              v-model="form.email"
              type="email"
              class="mt-1 block w-full"
              required
              autofocus
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
              autocomplete="current-password"
          />
          <InputError class="mt-2" :message="form.errors.password"/>
        </div>

        <div class="block mt-4">
          <label class="flex items-center">
            <Checkbox v-model:checked="form.remember" name="remember"/>
            <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Remember me</span>
          </label>
        </div>

        <div class="flex items-center justify-end mt-4">
          <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Log in
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

      <Socialstream v-if="$page.props.socialstream.show"/>
    </div>
  </AuthCard>
</template>
