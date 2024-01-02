<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import FileInput from "@/Components/Forms/FileInput.vue";
import ImagePreview from "@/Components/Forms/ImagePreview.vue";
import Checkbox from "@/Components/Forms/Checkbox.vue";

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
                <InputLabel
                    for="property_name"
                    value="Property name"
                    class="sr-only"
                />
                <TextInput
                    id="property_name"
                    type="text"
                    v-model="form.property_name"
                    required
                    autocomplete="property_name"
                    placeholder="Property name"
                />
                <InputError :message="form.errors.property_name" />

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
                <InputLabel
                    for="property_address_line_1"
                    value="Address line 1"
                    class="sr-only"
                />
                <TextInput
                    id="property_address_line_1"
                    type="text"
                    v-model="form.property_address_line_1"
                    required
                    autocomplete="property_address_line_1"
                    placeholder="Address line 1"
                />
                <InputError :message="form.errors.property_address_line_1" />

                <InputLabel
                    for="property_address_line_2"
                    value="Address line 2"
                    class="sr-only"
                />
                <TextInput
                    id="property_address_line_2"
                    type="text"
                    v-model="form.property_address_line_2"
                    autocomplete="property_address_line_2"
                    placeholder="Address line 2"
                />
                <InputError :message="form.errors.property_address_line_2" />

                <InputLabel
                    for="property_address_area"
                    value="City or area"
                    class="sr-only"
                />
                <TextInput
                    id="property_address_area"
                    type="text"
                    v-model="form.property_address_area"
                    required
                    autocomplete="property_address_area"
                    placeholder="City or area"
                />
                <InputError :message="form.errors.property_address_area" />

                <InputLabel
                    for="property_address_country"
                    value="Country"
                    class="sr-only"
                />
                <TextInput
                    id="property_address_country"
                    type="text"
                    v-model="form.property_address_country"
                    required
                    autocomplete="property_address_country"
                    placeholder="Country"
                />
                <InputError :message="form.errors.property_address_country" />

                <InputLabel
                    for="property_address_postcode"
                    value="Postcode"
                    class="sr-only"
                />
                <TextInput
                    id="property_address_postcode"
                    type="text"
                    v-model="form.property_address_postcode"
                    required
                    autocomplete="property_address_postcode"
                    placeholder="Postcode"
                />
                <InputError :message="form.errors.property_address_postcode" />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Enter your booking link. This should take users to a page where they can make a booking with your property.
                </p>
                <InputLabel
                    for="property_booking_link"
                    value="Booking link"
                    class="sr-only"
                />
                <TextInput
                    id="property_booking_link"
                    type="text"
                    v-model="form.property_booking_link"
                    required
                    autocomplete="property_booking_link"
                    placeholder="Booking link"
                />
                <InputError :message="form.errors.property_booking_link" />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Enter a phone number and email address for your property.
                </p>
                <InputLabel
                    for="property_telephone"
                    value="Telephone number"
                    class="sr-only"
                />
                <TextInput
                    id="property_telephone"
                    type="text"
                    v-model="form.property_telephone"
                    required
                    autocomplete="property_telephone"
                    placeholder="Telephone number"
                />
                <InputError :message="form.errors.property_telephone" />

                <InputLabel
                    for="property_email"
                    value="Email address"
                    class="sr-only"
                />
                <TextInput
                    id="property_email"
                    type="text"
                    v-model="form.property_email"
                    required
                    autocomplete="property_email"
                    placeholder="Email address"
                />
                <InputError :message="form.errors.property_email" />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Optionally, add links to any social media accounts you have for your property.
                </p>
                <InputLabel
                    for="property_twitter_link"
                    value="Twitter profile link"
                    class="sr-only"
                />
                <TextInput
                    id="property_twitter_link"
                    type="text"
                    v-model="form.property_twitter_link"
                    autocomplete="property_twitter_link"
                    placeholder="Twitter profile link"
                />
                <InputError :message="form.errors.property_twitter_link" />

                <InputLabel
                    for="property_youtube_link"
                    value="Youtube channel link"
                    class="sr-only"
                />
                <TextInput
                    id="property_youtube_link"
                    type="text"
                    v-model="form.property_youtube_link"
                    autocomplete="property_youtube_link"
                    placeholder="Youtube channel link"
                />
                <InputError :message="form.errors.property_youtube_link" />

                <InputLabel
                    for="property_linkedin_link"
                    value="Linkedin profile link"
                    class="sr-only"
                />
                <TextInput
                    id="property_linkedin_link"
                    type="text"
                    v-model="form.property_linkedin_link"
                    autocomplete="property_linkedin_link"
                    placeholder="Linkedin profile link"
                />
                <InputError :message="form.errors.property_linkedin_link" />

                <InputLabel
                    for="property_facebook_link"
                    value="Facebook profile link"
                    class="sr-only"
                />
                <TextInput
                    id="property_facebook_link"
                    type="text"
                    v-model="form.property_facebook_link"
                    autocomplete="property_facebook_link"
                    placeholder="Facebook profile link"
                />
                <InputError :message="form.errors.property_facebook_link" />

                <InputLabel
                    for="property_instagram_link"
                    value="Instagram profile link"
                    class="sr-only"
                />
                <TextInput
                    id="property_instagram_link"
                    type="text"
                    v-model="form.property_instagram_link"
                    autocomplete="property_instagram_link"
                    placeholder="Instagram profile link"
                />
                <InputError :message="form.errors.property_instagram_link" />

                <InputLabel
                    for="property_tripadvisor_link"
                    value="Tripadvisor page link"
                    class="sr-only"
                />
                <TextInput
                    id="property_tripadvisor_link"
                    type="text"
                    v-model="form.property_tripadvisor_link"
                    autocomplete="property_tripadvisor_link"
                    placeholder="Tripadvisor page link"
                />
                <InputError :message="form.errors.property_tripadvisor_link" />
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
