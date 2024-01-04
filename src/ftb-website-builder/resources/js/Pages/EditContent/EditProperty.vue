<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputError from "@/Components/Forms/InputError.vue";
import FileInput from "@/Components/Forms/FileInput.vue";
import ImagePreview from "@/Components/Forms/ImagePreview.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";

const props = defineProps({
    property_name: String,
    property_address_line_1: String,
    property_address_line_2: String,
    property_address_area: String,
    property_address_country: String,
    property_address_postcode: String,
    property_telephone: String,
    property_email: String,
    property_twitter_link: String,
    property_youtube_link: String,
    property_linkedin_link: String,
    property_facebook_link: String,
    property_instagram_link: String,
    property_tripadvisor_link: String,
    property_logo: String,
    property_booking_link: String,
});

const form = useForm({
    property_name: props.property_name,
    property_address_line_1: props.property_address_line_1,
    property_address_line_2: props.property_address_line_2,
    property_address_area: props.property_address_area,
    property_address_country: props.property_address_country,
    property_address_postcode: props.property_address_postcode,
    property_telephone: props.property_telephone,
    property_email: props.property_email,
    property_twitter_link: props.property_twitter_link,
    property_youtube_link: props.property_youtube_link,
    property_linkedin_link: props.property_linkedin_link,
    property_facebook_link: props.property_facebook_link,
    property_instagram_link: props.property_instagram_link,
    property_tripadvisor_link: props.property_tripadvisor_link,
    property_logo: null,
    remove_property_logo: false,
    property_booking_link: props.property_booking_link,
});

const property_logo = computed(() => {
    return form.remove_property_logo ? null : form.property_logo ?? props.property_logo
})

function submit() {
    form.post(route('edit.property.update'))
}
</script>

<template>
    <Head title="Edit your property details" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your property details
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Enter the name of your property.
                </p>
                <LabelledInputPair
                    v-model="form.property_name"
                    label="Property name"
                    :errorMessage="form.errors.property_name ?? ''"
                    fieldID="property_name"
                    required
                />

                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to serve as the logo for your property.
                </p>
                <FileInput
                    v-model="form.property_logo"
                    field-name="property_logo"
                />
                <InputError :message="form.errors.property_logo" />
                <ImagePreview
                    v-model="property_logo"
                    field-title="property logo"
                />
                <label
                    v-if="props.property_logo || form.property_logo"
                    class="wb-secondary-button ml-2"
                >
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_property_logo"
                        class="hidden"
                    />
                    <span v-if="form.remove_property_logo && (props.property_logo || form.property_logo)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.property_logo || form.property_logo">
                        Remove current image
                    </span>
                </label>
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Enter the address of your property.
                </p>

                <LabelledInputPair
                    v-model="form.property_address_line_1"
                    showLabel
                    label="Address line 1"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_line_1 ?? ''"
                    fieldID="property_address_line_1"
                    required
                />

                <LabelledInputPair
                    v-model="form.property_address_line_2"
                    showLabel
                    label="Address line 2"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_line_2 ?? ''"
                    fieldID="property_address_line_2"
                />

                <LabelledInputPair
                    v-model="form.property_address_area"
                    showLabel
                    label="City or area"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_area ?? ''"
                    fieldID="property_address_area"
                    required
                />

                <LabelledInputPair
                    v-model="form.property_address_country"
                    showLabel
                    label="Country"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_country ?? ''"
                    fieldID="property_address_country"
                    required
                />

                <LabelledInputPair
                    v-model="form.property_address_postcode"
                    showLabel
                    label="Postcode"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_postcode ?? ''"
                    fieldID="property_address_postcode"
                    required
                />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Enter your booking link. This should take users to a page where they can make a booking with your property.
                </p>

                <LabelledInputPair
                    v-model="form.property_booking_link"
                    label="Booking link"
                    :errorMessage="form.errors.property_booking_link ?? ''"
                    fieldID="property_booking_link"
                    required
                />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Enter a phone number and email address for your property.
                </p>

                <LabelledInputPair
                    v-model="form.property_telephone"
                    showLabel
                    label="Telephone number"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_telephone ?? ''"
                    fieldID="property_telephone"
                    required
                />

                <LabelledInputPair
                    v-model="form.property_email"
                    showLabel
                    label="Email address"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_email ?? ''"
                    fieldID="property_email"
                    required
                />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Optionally, add links to any social media accounts you have for your property.
                </p>

                <LabelledInputPair
                    v-model="form.property_facebook_link"
                    showLabel
                    label="Facebook profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_facebook_link ?? ''"
                    fieldID="property_facebook_link"
                />

                <LabelledInputPair
                    v-model="form.property_twitter_link"
                    showLabel
                    label="Twitter profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_twitter_link ?? ''"
                    fieldID="property_twitter_link"
                />

                <LabelledInputPair
                    v-model="form.property_instagram_link"
                    showLabel
                    label="Instagram profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_instagram_link ?? ''"
                    fieldID="property_instagram_link"
                />

                <LabelledInputPair
                    v-model="form.property_tripadvisor_link"
                    showLabel
                    label="Tripadvisor profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_tripadvisor_link ?? ''"
                    fieldID="property_tripadvisor_link"
                />

                <LabelledInputPair
                    v-model="form.property_linkedin_link"
                    showLabel
                    label="LinkedIn profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_linkedin_link ?? ''"
                    fieldID="property_linkedin_link"
                />

                <LabelledInputPair
                    v-model="form.property_youtube_link"
                    showLabel
                    label="YouTube profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_youtube_link ?? ''"
                    fieldID="property_youtube_link"
                />
            </div>

            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="wb-primary-button"
                >
                    Save
                </button>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="wb-text"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </LoggedInLayout>
</template>

<style scoped>

</style>
