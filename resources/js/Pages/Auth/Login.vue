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
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Socialstream from '@/Components/Socialstream.vue';

defineProps({
  status: String,
});

const signInWithEmail = ref(false);

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const socialsteamErrors = computed(() => usePage().props.value.errors.socialstream);

const toggleSignInWith = () => {
  signInWithEmail.value = !signInWithEmail.value;
};

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
      <div class="flex items-center justify-between">
        Login

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
        Access Your Account
      </div>
    </template>

    <div>
      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>

      <template v-if="signInWithEmail">
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

          <div class="flex items-center justify-between mt-4">
            <label class="flex items-center">
              <Checkbox v-model:checked="form.remember" name="remember"/>
              <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Remember me</span>
            </label>

            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Log in
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
            Sign in with email
          </button>
        </div>

        <div class="flex items-center justify-center">
          <Link
              :href="route('register')"
              class="text-sm font-normal text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200 underline underline-offset-2 mt-4 transition-all duration-200"
          >
            Not got an account?
          </Link>
        </div>
      </template>
    </div>
  </AuthCard>
</template>
