<script setup>
import {Head, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import ColourPickerGridItem from "@/Components/Forms/ColourPickerGridItem.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";

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

const fonts = [
    "Abril Fatface",
    "Archivo",
    "Archivo Black",
    "Arvo",
    "Barlow",
    "Bebas Neue",
    "Caveat",
    "Comfortaa",
    "Crimson Text",
    "Dancing Script",
    "Dela Gothic One",
    "Dosis",
    "Exo 2",
    "Figtree",
    "Genos",
    "IBM Plex Mono",
    "Indie Flower",
    "Instrument Serif",
    "Inter",
    "Josefin Sans",
    "Kalam",
    "Lato",
    "Lemon",
    "Libre Baskerville",
    "Lilita One",
    "Lobster",
    "Merriweather",
    "Montserrat",
    "Noto Sans",
    "Oswald",
    "Outfit",
    "Pacifico",
    "Playfair Display",
    "Poppins",
    "Questrial",
    "Rajdhani",
    "Raleway",
    "Roboto",
    "Roboto Condensed",
    "Roboto Mono",
    "Roboto Slab",
    "Salsa",
    "Satisfy",
    "Shadows Into Light",
    "Tektur",
];
</script>

<template>
    <Head title="Edit your styling choices" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your styling choices
        </h1>
        <form
            @submit.prevent="form.post(route('edit.website.update'))"
            class="space-y-8"
        >
            <FormSection prompt="Select the theme colours for your website. Make sure that the primary, secondary, and text colours will stand out against the background colour.">
                <div class="flex grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-6">
                    <ColourPickerGridItem
                        v-model="form.primary_colour"
                        :errorMessage="form.errors.primary_colour"
                        fieldID="primary_colour"
                        label="Primary colour"
                    />
                    <ColourPickerGridItem
                        v-model="form.secondary_colour"
                        :errorMessage="form.errors.secondary_colour"
                        fieldID="secondary_colour"
                        label="Secondary colour"
                    />
                    <ColourPickerGridItem
                        v-model="form.background_colour"
                        :errorMessage="form.errors.background_colour"
                        fieldID="background_colour"
                        label="Background colour"
                    />
                    <ColourPickerGridItem
                        v-model="form.text_colour"
                        :errorMessage="form.errors.text_colour"
                        fieldID="text_colour"
                        label="Text colour"
                    />
                </div>
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to customise the dividers in your website. Make sure to remove the background of your image if it is meant to be transparent.">
                <ImageInput
                    v-model="form.divider_art"
                    :errorMessage="form.errors.divider_art"
                    fieldTitle="divider art"
                    fieldID="divider_art"
                    v-model:removeCurrentImage="form.remove_divider_art"
                    :originalImage="props.divider_art"
                />
            </FormSection>

            <FormSection prompt="Optionally, you can select a font family to be used accross your website.">
                <InputLabel
                    for="font_family"
                    value="Font family"
                    class="sr-only"
                />
                <select
                    class="wb-input-box"
                    v-model="form.font_family"
                    :style="'font-family:' + form.font_family ?? 'Inter'"
                >
                    <option
                        disabled value=""
                        style="font-family: Inter, sans-serif"
                    >
                        Select a font family...
                    </option>
                    <option
                        v-for="font in fonts"
                        :style="'font-family:' + font"
                    >
                        {{ font }}
                    </option>
                </select>
                <InputError :message="form.errors.font_family" />
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
