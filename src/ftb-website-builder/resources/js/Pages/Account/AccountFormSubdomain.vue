<script setup>
import { useForm } from '@inertiajs/vue3';
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import DownloadIcon from "@/Components/Icons/DownloadIcon.vue";

const props = defineProps({
    subdomain: String,
});

const form = useForm({
    subdomain: props.subdomain,
});
</script>

<template>
    <section>
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            <div class="space-y-6">
                <header>
                    <h2 class="wb-subtitle">
                        Your website
                    </h2>
                    <p class="mt-1 wb-text">
                        We automatically host your website at the ftb.sites domain. If you would like to update this URL you can use the form below to edit the subdomain name. This should be all lowercase and contain no spaces.
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
            </div>
            <div class="wb-divider" />
            <div class="flex flex-col space-y-6">
                <header>
                    <h2 class="wb-subtitle">
                        Host yourself
                    </h2>
                    <p class="mt-1 wb-text">
                        Alternatively, you can host your website yourself. Click the button below to download a copy of your website, complete with instructions about how to run it.
                    </p>
                </header>

                <a
                    class="wb-primary-button w-max"
                    :href="route('download')"
                >
                    <DownloadIcon />
                    Download website
                </a>
            </div>
        </div>
    </section>
</template>
