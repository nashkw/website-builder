<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="wb-subtitle">
                Account Information
            </h2>
            <p class="mt-1 wb-text">
                Update your account's profile information and email address.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('account.update'))"
            class="space-y-6 flex flex-col w-full"
        >
            <FormSection>
                <LabelledInputPair
                    v-model="form.name"
                    showLabel
                    label="Name"
                    labelClass="w-16"
                    fieldID="name"
                    :errorMessage="form.errors.name"
                    required
                />
                <LabelledInputPair
                    v-model="form.email"
                    showLabel
                    label="Email"
                    labelClass="w-16"
                    fieldID="email"
                    :errorMessage="form.errors.email"
                    required
                    inputType="email"
                />
            </FormSection>

            <SaveButton
                :recently-successful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </section>
</template>
