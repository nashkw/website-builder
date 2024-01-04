<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import {computed} from 'vue'
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import ColourPickerGridItem from "@/Components/Forms/ColourPickerGridItem.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";

const props = defineProps({
    primary_colour: String,
    secondary_colour: String,
    background_colour: String,
    text_colour: String,
    divider_art: String,
    font_family: String,
});

const form = useForm({
    primary_colour: props.primary_colour,
    secondary_colour: props.secondary_colour,
    background_colour: props.background_colour,
    text_colour: props.text_colour,
    divider_art: null,
    remove_divider_art: false,
    font_family: props.font_family,
});

const divider_art = computed(() => {
    return form.remove_divider_art ? null : form.divider_art ?? props.divider_art;
})

function updatePrimaryColour (eventData) {
    form.primary_colour = eventData.cssColor.replace('#', '');
}
function updateSecondaryColour (eventData) {
    form.secondary_colour = eventData.cssColor.replace('#', '');
}
function updateBackgroundColour (eventData) {
    form.background_colour = eventData.cssColor.replace('#', '');
}
function updateTextColour (eventData) {
    form.text_colour = eventData.cssColor.replace('#', '');
}

function submit() {
    form.post(route('edit.website.update'))
}
</script>

<template>
    <Head title="Edit your styling choices" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your styling choices
        </h1>
        <form
            @submit.prevent="submit"
            class="space-y-8"
        >
            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Select the theme colours for your website.
                </p>
                <div class="flex grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-6">
                    <ColourPickerGridItem
                        :modelValue="form.primary_colour"
                        @update:modelValue="updatePrimaryColour"
                        :errorMessage="form.errors.primary_colour"
                        fieldID="primary_colour"
                        label="Primary colour"
                    />

                    <ColourPickerGridItem
                        :modelValue="form.secondary_colour"
                        @update:modelValue="updateSecondaryColour"
                        :errorMessage="form.errors.secondary_colour"
                        fieldID="secondary_colour"
                        label="Secondary colour"
                    />

                    <ColourPickerGridItem
                        :modelValue="form.background_colour"
                        @update:modelValue="updateBackgroundColour"
                        :errorMessage="form.errors.background_colour"
                        fieldID="background_colour"
                        label="Background colour"
                    />

                    <ColourPickerGridItem
                        :modelValue="form.text_colour"
                        @update:modelValue="updateTextColour"
                        :errorMessage="form.errors.text_colour"
                        fieldID="text_colour"
                        label="Text colour"
                    />
                </div>
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to customise the dividers in your website. Make sure to remove the background of your image if it is meant to be transparent.
                </p>
                <ImageInput
                    v-model="form.divider_art"
                    :currentImage="divider_art"
                    :errorMessage="form.errors.divider_art"
                    fieldTitle="divider art"
                    fieldID="divider_art"
                    v-model:removeCurrentImage="form.remove_divider_art"
                    :originalImage="props.divider_art"
                />
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Optionally, you can select a font family to be used accross your website.
                </p>
                <LabelledInputPair
                    v-model="form.font_family"
                    label="Font family"
                    :errorMessage="form.errors.font_family"
                    fieldID="font_family"
                />
            </div>

            <SaveButton
                :recently-successful="form.recentlySuccessful"
                :processing="form.processing"
            />
        </form>
    </LoggedInLayout>
</template>

<style scoped>

</style>
