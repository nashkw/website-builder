<script setup>
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import Modal from '@/Components/Structural/Modal.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('account.destroy'), {
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
    <section class="space-y-6">
        <header>
            <h2 class="wb-subtitle">
                Delete Account
            </h2>
            <p class="mt-1 wb-text">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please make sure this account does not contain any data or information that you wish to retain.
            </p>
        </header>

        <button
            @click="confirmUserDeletion"
            class="wb-primary-button"
        >
            Delete Account
        </button>

        <Modal
            :show="confirmingUserDeletion"
            @close="closeModal"
        >
            <div class="p-6 space-y-4">
                <h2 class="wb-subtitle">
                    Are you sure you want to delete your account?
                </h2>
                <p class="mt-1 wb-text">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="space-y-2">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex justify-end space-x-3">
                    <button
                        @click="closeModal"
                        class="wb-secondary-button"
                    >
                        Cancel
                    </button>
                    <button
                        :disabled="form.processing"
                        @click="deleteUser"
                        class="wb-primary-button"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Delete Account
                    </button>
                </div>
            </div>
        </Modal>
    </section>
</template>
