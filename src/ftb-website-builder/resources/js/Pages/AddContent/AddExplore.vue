<script setup>
import {useForm} from "@inertiajs/vue3";
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

const form = useForm({
    explore_page_section_header: "",
    explore_page_section_paragraph: "",
    explore_page_section_image: null,
    remove_explore_page_section_image: false,
    attractions: [],
});

function addAttraction() {
    form.attractions.push({
        attraction_header: null,
        attraction_paragraph: null,
        attraction_image: null,
    });
}

function removeAttraction(index) {
    form.attractions.splice(index, 1);
}
</script>

<template>
    <AppHead title="Add an Explore page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Add an Explore page
        </h1>
        <form
            @submit.prevent="form.post(route('add.explore.create'))"
            class="space-y-8"
        >
            <FormSection prompt="Write a header to sit at the top of your explore page. Optionally, you can write a body paragraph telling customers what they can do while they stay at your property. This can be however long you want, although detailed information about each attraction would work better as attraction descriptions.">
                <LabelledInputPair
                    v-model="form.explore_page_section_header"
                    label="Page header"
                    placeholder="Things to do"
                    :errorMessage="form.errors.explore_page_section_header"
                    fieldID="explore_page_section_header"
                    required
                />
                <InputLabel
                    for="explore_page_section_paragraph"
                    value="Explore paragraph"
                    class="sr-only"
                />
                <textarea
                    id="explore_page_section_paragraph"
                    type="text"
                    v-model="form.explore_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    autocomplete="explore_page_section_paragraph"
                    placeholder="All explore our property..."
                />
                <InputError :message="form.errors.explore_page_section_paragraph" />
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to accompany this section.">
                <ImageInput
                    v-model="form.explore_page_section_image"
                    :errorMessage="form.errors.explore_page_section_image"
                    fieldTitle="section image"
                    fieldID="explore_page_section_image"
                    v-model:removeCurrentImage="form.remove_explore_page_section_image"
                    :originalImage="null"
                />
            </FormSection>

            <FormSection prompt="Add things to do near your property. Optionally, you can add an image of each attraction.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <RemovableCard
                        v-for="(attraction, index) in form.attractions"
                        :removeFunction="removeAttraction"
                        :params="[index]"
                    >
                        <LabelledInputPair
                            v-model="attraction.attraction_header"
                            label="Name of attraction"
                            :errorMessage="form.errors['attractions.' + index + '.attraction_header']"
                            :fieldID="'attraction_header_' + index"
                            required
                        />
                        <InputLabel
                            :for="'attraction_paragraph_' + index"
                            value="Attraction description"
                            class="sr-only"
                        />
                        <textarea
                            :id="'attraction_paragraph_' + index"
                            type="text"
                            v-model="attraction.attraction_paragraph"
                            class="wb-input-box h-40 s:h-20"
                            required
                            :autocomplete="'attraction_paragraph_' + index"
                            placeholder="This attraction is..."
                        />
                        <InputError :message="form.errors['attractions.' + index + '.attraction_paragraph']" />
                        <ImageInput
                            v-model="attraction.attraction_image"
                            :errorMessage="form.errors['attractions.' + index + '.attraction_image']"
                            fieldTitle="attraction image"
                            :fieldID="'attraction_image_' + index"
                            v-model:removeCurrentImage="attraction.remove_attraction_image"
                            :originalImage="typeof(attraction.attraction_image) === String ? attraction.attraction_image : null"
                        />
                    </RemovableCard>
                    <InputError :message="form.errors.attractions" />
                    <PlusOrCrossButton
                        v-on:click="addAttraction"
                        text="Add attraction"
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
