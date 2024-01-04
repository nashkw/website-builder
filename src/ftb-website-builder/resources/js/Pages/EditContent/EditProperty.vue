<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";

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
</script>

<template>
    <Head title="Edit your property details" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your property details
        </h1>
        <form
            @submit.prevent="form.post(route('edit.property.update'))"
            class="space-y-8"
        >
            <FormSection prompt="Enter the name of your property.">
                <LabelledInputPair
                    v-model="form.property_name"
                    label="Property name"
                    :errorMessage="form.errors.property_name"
                    fieldID="property_name"
                    required
                />
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to serve as the logo for your property.">
                <ImageInput
                    v-model="form.property_logo"
                    :errorMessage="form.errors.property_logo"
                    fieldTitle="property logo"
                    fieldID="property_logo"
                    v-model:removeCurrentImage="form.remove_property_logo"
                    :originalImage="props.property_logo"
                />
            </FormSection>

            <FormSection prompt="Enter the address of your property.">
                <LabelledInputPair
                    v-model="form.property_address_line_1"
                    showLabel
                    label="Address line 1"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_line_1"
                    fieldID="property_address_line_1"
                    required
                />
                <LabelledInputPair
                    v-model="form.property_address_line_2"
                    showLabel
                    label="Address line 2"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_line_2"
                    fieldID="property_address_line_2"
                />
                <LabelledInputPair
                    v-model="form.property_address_area"
                    showLabel
                    label="City or area"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_area"
                    fieldID="property_address_area"
                    required
                />
                <LabelledInputPair
                    v-model="form.property_address_country"
                    showLabel
                    label="Country"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_country"
                    fieldID="property_address_country"
                    required
                />
                <LabelledInputPair
                    v-model="form.property_address_postcode"
                    showLabel
                    label="Postcode"
                    labelClass="w-28"
                    :errorMessage="form.errors.property_address_postcode"
                    fieldID="property_address_postcode"
                    required
                />
            </FormSection>

            <FormSection prompt="Enter your booking link. This should take users to a page where they can make a booking with your property.">
                <LabelledInputPair
                    v-model="form.property_booking_link"
                    label="Booking link"
                    :errorMessage="form.errors.property_booking_link"
                    fieldID="property_booking_link"
                    required
                />
            </FormSection>

            <FormSection prompt="Enter a phone number and email address for your property.">
                <LabelledInputPair
                    v-model="form.property_telephone"
                    showLabel
                    label="Telephone number"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_telephone"
                    fieldID="property_telephone"
                    required
                />
                <LabelledInputPair
                    v-model="form.property_email"
                    showLabel
                    label="Email address"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_email"
                    fieldID="property_email"
                    required
                />
            </FormSection>

            <FormSection prompt="Optionally, add links to any social media accounts you have for your property.">
                <LabelledInputPair
                    v-model="form.property_facebook_link"
                    showLabel
                    label="Facebook profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_facebook_link"
                    fieldID="property_facebook_link"
                />
                <LabelledInputPair
                    v-model="form.property_twitter_link"
                    showLabel
                    label="Twitter profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_twitter_link"
                    fieldID="property_twitter_link"
                />
                <LabelledInputPair
                    v-model="form.property_instagram_link"
                    showLabel
                    label="Instagram profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_instagram_link"
                    fieldID="property_instagram_link"
                />
                <LabelledInputPair
                    v-model="form.property_tripadvisor_link"
                    showLabel
                    label="Tripadvisor profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_tripadvisor_link"
                    fieldID="property_tripadvisor_link"
                />
                <LabelledInputPair
                    v-model="form.property_linkedin_link"
                    showLabel
                    label="LinkedIn profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_linkedin_link"
                    fieldID="property_linkedin_link"
                />
                <LabelledInputPair
                    v-model="form.property_youtube_link"
                    showLabel
                    label="YouTube profile"
                    labelClass="w-36"
                    :errorMessage="form.errors.property_youtube_link"
                    fieldID="property_youtube_link"
                />
            </FormSection>

            <SaveButton
                :recentlySuccessful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </LoggedInLayout>
</template>

<style scoped>

</style>
