<script setup>
import {computed} from 'vue';
import {Head, Link, useForm, usePage} from '@inertiajs/inertia-vue3';
import AuthCard from '@/Components/Auth/Card.vue';
import AuthCardLogo from '@/Components/Auth/CardLogo.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetCheckbox from '@/Components/Checkbox.vue';
import JetLabel from '@/Components/Label.vue';

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

    <JetInputError class="mb-4" :message="socialsteamErrors"/>

    <div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div>
            <JetLabel for="email" value="Email"/>
            <JetInput
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                required
                autofocus
            />
            <JetInputError class="mt-2" :message="form.errors.email"/>
          </div>

          <div class="mt-4">
            <JetLabel for="password" value="Password"/>
            <JetInput
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="current-password"
            />
            <JetInputError class="mt-2" :message="form.errors.password"/>
          </div>

          <div class="block mt-4">
            <label class="flex items-center">
              <JetCheckbox v-model:checked="form.remember" name="remember"/>
              <span class="ml-2 text-sm text-slate-600 dark:text-slate-300">Remember me</span>
            </label>
          </div>

          <div class="flex items-center justify-end mt-4">
            <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Log in
            </JetButton>
          </div>
        </form>
    </div>
  </AuthCard>
</template>
