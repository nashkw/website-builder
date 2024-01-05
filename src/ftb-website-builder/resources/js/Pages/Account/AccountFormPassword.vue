<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="wb-subtitle">
                Update Password
            </h2>
            <p class="mt-1 wb-text">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </header>

        <form
            @submit.prevent="updatePassword"
            class="space-y-6 flex flex-col w-full"
        >
            <FormSection>
                <LabelledInputPair
                    v-model="form.current_password"
                    showLabel
                    label="Current Password"
                    labelClass="w-32"
                    fieldID="current_password"
                    :errorMessage="form.errors.current_password"
                    required
                    inputType="password"
                />
                <LabelledInputPair
                    v-model="form.password"
                    showLabel
                    label="New Password"
                    labelClass="w-32"
                    fieldID="password"
                    :errorMessage="form.errors.password"
                    required
                    inputType="password"
                />
                <LabelledInputPair
                    v-model="form.password_confirmation"
                    showLabel
                    label="Confirm Password"
                    labelClass="w-32"
                    fieldID="password_confirmation"
                    :errorMessage="form.errors.password_confirmation"
                    required
                    inputType="password"
                />
            </FormSection>

            <SaveButton
                :recently-successful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </section>
</template>
