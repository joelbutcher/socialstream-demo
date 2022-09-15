<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DialogModal from '@/Components/DialogModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  user: Object,
});

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: '',
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
  form.delete(route('users.destroy', props.user.id), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};
</script>

<template>
  <ActionSection>
    <template #title>
      Delete User
    </template>

    <template #description>
      Permanently this user account..
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-slate-600 dark:text-slate-400">
        Once this account is deleted, all of its resources and data will be permanently deleted. Before deleting the account, please download any data or information that you wish to retain.
      </div>

      <div class="mt-5">
        <DangerButton @click="confirmUserDeletion">
          Delete User
        </DangerButton>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <DialogModal :show="confirmingUserDeletion" @close="closeModal">
        <template #title>
          Delete User
        </template>

        <template #content>
          Are you sure you want to delete this account? Once the account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete the account.

          <div class="mt-4">
            <TextInput
                ref="passwordInput"
                v-model="form.password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="Password"
                @keyup.enter="deleteUser"
            />

            <InputError :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <SecondaryButton @click="closeModal">
            Cancel
          </SecondaryButton>

          <DangerButton
              class="ml-3"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="deleteUser"
          >
            Delete User
          </DangerButton>
        </template>
      </DialogModal>
    </template>
  </ActionSection>
</template>
