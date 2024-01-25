<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";

const props = defineProps({
    subdomain: String,
});

const form = useForm({
    subdomain: props.subdomain,
});
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="wb-subtitle">
                Website Link
            </h2>
            <p class="mt-1 wb-text">
                Update the subdomain in your website URL. This should be all lowercase and contain no spaces.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('account.subdomain'))"
            class="space-y-6 flex flex-col w-full"
        >
            <FormSection>
                <LabelledInputPair
                    v-model="form.subdomain"
                    label="Website Name"
                    :errorMessage="form.errors.subdomain"
                    fieldID="subdomain"
                    inputType="subdomain"
                    required
                />
            </FormSection>

            <SaveButton
                :recently-successful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </section>
</template>
