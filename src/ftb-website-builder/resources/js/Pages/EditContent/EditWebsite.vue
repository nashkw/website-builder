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
import { ColorPicker } from 'vue-accessible-color-picker'
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";

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
                    <div class="flex flex-col justify-center space-y-2 max-2xl:w-max ">
                        <div class="flex flex-row justify-between mx-2">
                            <InputLabel
                                for="primary_colour"
                                value="Primary colour"
                            />
                            <div
                                class="wb-color-patch"
                                :style="{ backgroundColor: '#' + form.primary_colour}"
                            />
                        </div>

                        <ColorPicker
                            class="wb-colour-picker"
                            :color="'#' + form.primary_colour"
                            alpha-channel="hide"
                            default-format="hex"
                            :visible-formats="['hex']"
                            id="primary_colour"
                            @color-change="updatePrimaryColour"
                        />
                        <InputError :message="form.errors.primary_colour" />
                    </div>

                    <div class="flex flex-col justify-center space-y-2 max-2xl:w-max ">
                        <div class="flex flex-row justify-between mx-2">
                            <InputLabel
                                for="secondary_colour"
                                value="Secondary colour"
                            />
                            <div
                                class="wb-color-patch"
                                :style="{ backgroundColor: '#' + form.secondary_colour}"
                            />
                        </div>
                        <ColorPicker
                            class="wb-colour-picker"
                            :color="'#' + form.secondary_colour"
                            alpha-channel="hide"
                            default-format="hex"
                            :visible-formats="['hex']"
                            id="secondary_colour"
                            @color-change="updateSecondaryColour"
                        />
                        <InputError :message="form.errors.secondary_colour" />
                    </div>

                    <div class="flex flex-col justify-center space-y-2 max-2xl:w-max ">
                        <div class="flex flex-row justify-between mx-2">
                            <InputLabel
                                for="background_colour"
                                value="Background colour"
                            />
                            <div
                                class="wb-color-patch"
                                :style="{ backgroundColor: '#' + form.background_colour}"
                            />
                        </div>
                        <ColorPicker
                            class="wb-colour-picker"
                            :color="'#' + form.background_colour"
                            alpha-channel="hide"
                            default-format="hex"
                            :visible-formats="['hex']"
                            id="background_colour"
                            @color-change="updateBackgroundColour"
                        />
                        <InputError :message="form.errors.background_colour" />
                    </div>

                    <div class="flex flex-col justify-center space-y-2 max-2xl:w-max ">
                        <div class="flex flex-row justify-between mx-2">
                            <InputLabel
                                for="text_colour"
                                value="Text colour"
                            />
                            <div
                                class="wb-color-patch"
                                :style="{ backgroundColor: '#' + form.text_colour}"
                            />
                        </div>
                        <ColorPicker
                            class="wb-colour-picker"
                            :color="'#' + form.text_colour"
                            alpha-channel="hide"
                            default-format="hex"
                            :visible-formats="['hex']"
                            id="text_colour"
                            @color-change="updateTextColour"
                        />
                        <InputError :message="form.errors.text_colour" />
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Optionally, you can attach an image to customise the dividers in your website. Make sure to remove the background of your image if it is meant to be transparent.
                </p>
                <FileInput
                    v-model="form.divider_art"
                    field-name="divider_art"
                />
                <InputError :message="form.errors.divider_art" />
                <ImagePreview
                    v-model="divider_art"
                    field-title="divider art"
                />
                <label
                    v-if="props.divider_art || form.divider_art"
                    class="wb-secondary-button ml-2"
                >
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remove_divider_art"
                        class="hidden"
                    />
                    <span v-if="form.remove_divider_art && (props.divider_art || form.divider_art)">
                        No image selected. Use saved image?
                    </span>
                    <span v-else-if="props.divider_art || form.divider_art">
                        Remove current image
                    </span>
                </label>
            </div>

            <div class="space-y-2">
                <p class="wb-subtitle p-2">
                    Optionally, you can select a font family to be used accross your website.
                </p>
                <LabelledInputPair
                    v-model="form.font_family"
                    label="Font family"
                    :errorMessage="form.errors.font_family ?? ''"
                    fieldID="font_family"
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
