<script setup>
import {useForm, usePage} from '@inertiajs/inertia-vue3';
import {ref} from 'vue';
import JetActionSection from '@/Components/ActionSection.vue';
import JetButton from '@/Components/PrimaryButton.vue';
import JetDialogModal from '@/Components/DialogModal.vue';
import JetSecondaryButton from '@/Components/SecondaryButton.vue';
import ConnectedAccount from '@/Components/ConnectedAccount.vue';

const confirmingRemove = ref(false);

const accountId = ref(null);

const inertiaProps = usePage().props;

const form = useForm({
    _method: 'DELETE',
    bag: 'removeConnectedAccount'
});

const confirmRemove = (id) => {
    form.transform((data) => ({
        ...data,
        password: ''
    }));
    accountId.value = id;
    confirmingRemove.value = true;
}

const hasAccountForProvider = (provider) => (
    inertiaProps.value.socialstream.connectedAccounts.filter(
        account => account.provider === provider
    ).length > 0
);

const getAccountForProvider = (provider) => (hasAccountForProvider(provider))
    ? inertiaProps.value.socialstream.connectedAccounts
        .filter(account => account.provider === provider)
        .shift()
    : undefined;

const removeConnectedAccount = (id) => {
    form.post(route('connected-accounts.destroy', { id }), {
        preserveScroll: true,
        onSuccess: () => (confirmingRemove.value = false)
    });
}

</script>

<template>
  <JetActionSection>
    <template #title>
      Connected Accounts
    </template>

    <template #description>
      Manage and remove your connected accounts.
    </template>

    <template #content>
      <h3 class="text-lg font-medium text-slate-900 dark:text-slate-100"
          v-if="$page.props.socialstream.connectedAccounts.length === 0">
        You have no connected accounts.
      </h3>
      <h3 class="text-lg font-medium text-slate-900 dark:text-slate-100" v-else>
        Your connected accounts.
      </h3>

      <div class="max-w-xl text-sm text-slate-600 dark:text-slate-400">
        You are free to connect any social accounts to your profile and may remove any connected accounts at any
        time. If you feel any of your connected accounts have been compromised, you should disconnect them
        immediately and change your password.
      </div>

      <div class="mt-5 divide-y divide-gray-200">
        <div v-for="(provider) in $page.props.socialstream.providers" :key="provider">
          <ConnectedAccount
              :provider="provider"
              @confirm-remove-connected-account="confirmRemove(getAccountForProvider(provider).id)"
          />
        </div>
      </div>

      <!-- Confirmation Modal -->
      <JetDialogModal :show="confirmingRemove" @close="confirmingRemove = false">
        <template #title>
          Remove Connected Account
        </template>

        <template #content>
          Please confirm your removal of this account - this action cannot be undone.
        </template>

        <template #footer>
          <JetSecondaryButton @click="confirmingRemove = false">
            Cancel
          </JetSecondaryButton>

          <JetButton class="ml-2" @click="removeConnectedAccount(accountId)"
                     :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Remove
          </JetButton>
        </template>
      </JetDialogModal>
    </template>
  </JetActionSection>
</template>
