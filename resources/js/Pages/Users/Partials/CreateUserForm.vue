<script setup>
// Core
import {ref} from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { DocumentDuplicateIcon } from '@heroicons/vue/24/solid';

// Components
import JetButton from '@/Components/Button.vue';
import JetFormSection from '@/Components/FormSection.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetActionMessage from '@/Components/ActionMessage.vue';
import JetLabel from '@/Components/Label.vue';

const passwordCopied = ref(false);

const props = defineProps({
  password: String,
});

const form = useForm({
  first_name: '',
  last_name: '',
  email: '',
  password: props.password,
});

const createUser = () => {
  form.post(route('users.store'), {
    errorBag: 'createUser',
    preserveScroll: true,
    onSuccess: () => clearForm(),
  });
};

const copyPassword = () => {
  console.log(form.password);
  navigator.clipboard.writeText(form.password);

  passwordCopied.value = true;

  setTimeout(() => {
    passwordCopied.value = false;
  }, 400)
}
</script>

<template>
  <JetFormSection @submitted="createUser">
    <template #title>
      User Details
    </template>

    <template #description>
      Create a new user and grant them access to your application.
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-2">
        <JetLabel for="first_name" value="First Name" />
        <JetInput
            id="first_name"
            v-model="form.first_name"
            type="text"
            class="block w-full mt-1"
            autofocus
        />
        <JetInputError :message="form.errors.first_name" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-2">
        <JetLabel for="last_name" value="Last Name" />
        <JetInput
            id="last_name"
            v-model="form.last_name"
            type="text"
            class="block w-full mt-1"
        />
        <JetInputError :message="form.errors.last_name" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <JetLabel for="email" value="Email" />
        <JetInput
            id="email"
            v-model="form.email"
            type="text"
            class="block w-full mt-1"
        />
        <JetInputError :message="form.errors.email" class="mt-2" />
      </div>

      <!-- Password (auto-generated and pre-populated -->
      <div class="col-span-6 sm:col-span-4">
        <JetLabel for="password" value="Password" />
        <div class="relative flex items-center">
          <JetInput
              disabled
              aria-disabled="true"
              v-model="$page.props.password"
              type="password"
              class="block w-full mt-1"
          />

          <button type="button" @click="copyPassword" class="cursor-pointer absolute right-2 mt-1">
            <DocumentDuplicateIcon class="text-slate-500 w-5 h-5"/>
          </button>

          <JetActionMessage :on="passwordCopied" class="absolute left-full ml-2 mt-1">
            Copied
          </JetActionMessage>
        </div>

        <div class="flex items-center text-sm text-slate-400 dark:text-slate-500 mt-2">
          This password is automatically generated and will be emailed to the user.
        </div>
      </div>
    </template>

    <template #actions>
      <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Create
      </JetButton>
    </template>
  </JetFormSection>
</template>
