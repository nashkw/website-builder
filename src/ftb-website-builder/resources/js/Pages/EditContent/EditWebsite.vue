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
    return form.remove_divider_art ? null : form.divider_art ?? props.divider_art
})

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
                <InputLabel
                    for="primary_colour"
                    value="Primary colour"
                    class="sr-only"
                />
                <TextInput
                    id="primary_colour"
                    type="text"
                    v-model="form.primary_colour"
                    required
                    autocomplete="primary_colour"
                    placeholder="Primary colour"
                />
                <InputError :message="form.errors.primary_colour" />

                <InputLabel
                    for="secondary_colour"
                    value="Secondary colour"
                    class="sr-only"
                />
                <TextInput
                    id="secondary_colour"
                    type="text"
                    v-model="form.secondary_colour"
                    required
                    autocomplete="secondary_colour"
                    placeholder="Secondary colour"
                />
                <InputError :message="form.errors.secondary_colour" />

                <InputLabel
                    for="background_colour"
                    value="Background colour"
                    class="sr-only"
                />
                <TextInput
                    id="background_colour"
                    type="text"
                    v-model="form.background_colour"
                    required
                    autocomplete="background_colour"
                    placeholder="Background colour"
                />
                <InputError :message="form.errors.background_colour" />

                <InputLabel
                    for="text_colour"
                    value="Text colour"
                    class="sr-only"
                />
                <TextInput
                    id="text_colour"
                    type="text"
                    v-model="form.text_colour"
                    required
                    autocomplete="text_colour"
                    placeholder="Text colour"
                />
                <InputError :message="form.errors.text_colour" />
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
                <InputLabel
                    for="font_family"
                    value="Font family"
                    class="sr-only"
                />
                <TextInput
                    id="font_family"
                    type="text"
                    v-model="form.font_family"
                    autocomplete="font_family"
                    placeholder="Font family"
                />
                <InputError :message="form.errors.font_family" />
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
