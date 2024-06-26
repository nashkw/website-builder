<script setup>
import {router, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import PlusOrCrossButton from "@/Components/Buttons/PlusOrCrossButton.vue";
import AppHead from "@/Layout/AppHead.vue";
import RemovableCard from "@/Components/Buttons/RemovableCard.vue";

const props = defineProps({
    find_us_page_section_header: String,
    find_us_page_section_paragraph: String,
    find_us_page_section_image: String,
    directions: Array,
});

const form = useForm({
    find_us_page_section_header: props.find_us_page_section_header,
    find_us_page_section_paragraph: props.find_us_page_section_paragraph,
    find_us_page_section_image: null,
    remove_find_us_page_section_image: false,
    directions: props.directions,
    directions_to_remove: [],
});

function addDirection() {
    form.directions.push({
        id: null,
        directions_label: null,
        directions_paragraph: null,
    });
}

function removeDirection(index) {
    if(form.directions[index].id) {
        form.directions_to_remove.push(form.directions[index].id);
    }
    form.directions.splice(index, 1);
}

router.on('success', (event) => {
    // reset directions fields when form is submitted successfully
    form.directions = props.directions;
    form.directions_to_remove = [];
})
</script>

<template>
    <AppHead title="Edit your Find Us page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Find Us page
        </h1>
        <form
            @submit.prevent="form.post(route('edit.findus.update'))"
            class="space-y-8"
        >
            <FormSection prompt="Write a header and a body paragraph telling potential customers how they can find your property and what they should do when they arrive. This can be however long you want, although if you want to add directions from specific places these should consider splitting them into individual directions listings.">
                <LabelledInputPair
                    v-model="form.find_us_page_section_header"
                    label="Page header"
                    placeholder="How to find our property"
                    :errorMessage="form.errors.find_us_page_section_header"
                    fieldID="find_us_page_section_header"
                    required
                />
                <InputLabel
                    for="find_us_page_section_paragraph"
                    value="Find Us paragraph"
                    class="sr-only"
                />
                <textarea
                    id="find_us_page_section_paragraph"
                    type="text"
                    v-model="form.find_us_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    required
                    autocomplete="find_us_page_section_paragraph"
                    placeholder="Our property can be found by..."
                />
                <InputError :message="form.errors.find_us_page_section_paragraph" />
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to accompany this section.">
                <ImageInput
                    v-model="form.find_us_page_section_image"
                    :errorMessage="form.errors.find_us_page_section_image"
                    fieldTitle="section image"
                    fieldID="find_us_page_section_image"
                    v-model:removeCurrentImage="form.remove_find_us_page_section_image"
                    :originalImage="props.find_us_page_section_image"
                />
            </FormSection>

            <FormSection prompt="Optionally, you can add sets of directions to your Find Us page. For best results try to keep the directions a similar length.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <RemovableCard
                        v-for="(direction, index) in form.directions"
                        :removeFunction="removeDirection"
                        :params="[index]"
                    >
                        <LabelledInputPair
                            v-model="direction.directions_label"
                            label="Directions label"
                            placeholder="Name of directions set"
                            :errorMessage="form.errors['directions.' + index + '.directions_label']"
                            :fieldID="'directions_label_' + index"
                            required
                        />
                        <InputLabel
                            :for="'directions_paragraph_' + index"
                            value="Directions paragraph"
                            class="sr-only"
                        />
                        <textarea
                            :id="'directions_paragraph_' + index"
                            type="text"
                            v-model="direction.directions_paragraph"
                            class="wb-input-box h-40 s:h-20"
                            required
                            :autocomplete="'directions_paragraph_' + index"
                            placeholder="The directions are..."
                        />
                        <InputError :message="form.errors['directions.' + index + '.directions_paragraph']" />
                    </RemovableCard>
                    <InputError :message="form.errors.directions" />
                    <PlusOrCrossButton
                        v-on:click="addDirection"
                        text="Add set of directions"
                    />
                </div>
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
