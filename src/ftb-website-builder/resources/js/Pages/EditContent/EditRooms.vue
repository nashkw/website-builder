<script setup>
import {Head, router, useForm} from "@inertiajs/vue3";
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import LabelledInputPair from "@/Components/Forms/LabelledInputPair.vue";
import ImageInput from "@/Components/Forms/ImageInput.vue";
import SaveButton from "@/Components/Buttons/SaveButton.vue";
import FormSection from "@/Components/Structural/FormSection.vue";
import PlusOrCrossButton from "@/Components/Buttons/PlusOrCrossButton.vue";

const props = defineProps({
    rooms_page_section_header: String,
    rooms_page_section_paragraph: String,
    rooms_page_section_image: String,
    rooms: Array,
});

const form = useForm({
    rooms_page_section_header: props.rooms_page_section_header,
    rooms_page_section_paragraph: props.rooms_page_section_paragraph,
    rooms_page_section_image: null,
    remove_rooms_page_section_image: false,
    rooms: props.rooms,
    rooms_to_remove: [],
});

function addRoom() {
    form.rooms.push({
        id: null,
        room_name: null,
        room_description: null,
        room_image_primary: null,
    });
}

function removeRoom(index) {
    if(form.rooms[index].id) {
        form.rooms_to_remove.push(form.rooms[index].id);
    }
    form.rooms.splice(index, 1);
}

router.on('success', (event) => {
    // reset room fields when form is submitted successfully
    form.rooms = props.rooms;
    form.rooms_to_remove = [];
})
</script>

<template>
    <Head title="Edit your Rooms page" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Edit your Rooms page
        </h1>
        <form
            @submit.prevent="form.post(route('edit.rooms.update'))"
            class="space-y-8"
        >
            <FormSection prompt="Write a header to sit at the top of your Rooms page. Optionally, you can write a body paragraph giving potential customers an overview of the rooms you have available. This can be however long you want, although detailed information about each room would work better as room descriptions.">
                <LabelledInputPair
                    v-model="form.rooms_page_section_header"
                    label="Page header"
                    placeholder="Our Rooms"
                    :errorMessage="form.errors.rooms_page_section_header"
                    fieldID="rooms_page_section_header"
                    required
                />
                <InputLabel
                    for="rooms_page_section_paragraph"
                    value="Rooms paragraph"
                    class="sr-only"
                />
                <textarea
                    id="rooms_page_section_paragraph"
                    type="text"
                    v-model="form.rooms_page_section_paragraph"
                    class="wb-input-box h-40 s:h-20"
                    autocomplete="rooms_page_section_paragraph"
                    placeholder="Our rooms are..."
                />
                <InputError :message="form.errors.rooms_page_section_paragraph" />
            </FormSection>

            <FormSection prompt="Optionally, you can attach an image to accompany this section.">
                <ImageInput
                    v-model="form.rooms_page_section_image"
                    :errorMessage="form.errors.rooms_page_section_image"
                    fieldTitle="section image"
                    fieldID="rooms_page_section_image"
                    v-model:removeCurrentImage="form.remove_rooms_page_section_image"
                    :originalImage="props.rooms_page_section_image"
                />
            </FormSection>

            <FormSection prompt="Add the rooms available at your property. If you have multiple rooms of each type it would be best to list room types instead of individual rooms. Each room you list should have a name, a short description of what a guest can expect if they book it, and a picture of the room. Optionally, you can include additional pictures of the room.">
                <div class="flex flex-col gap-4 justify-center items-center">
                    <div
                        v-for="(room, index) in form.rooms"
                        class="wb-card space-y-2"
                    >
                        <LabelledInputPair
                            v-model="room.room_name"
                            label="Name of room"
                            :errorMessage="form.errors['rooms.' + index + '.room_name']"
                            :fieldID="'room_name_' + index"
                            required
                        />
                        <InputLabel
                            :for="'room_description_' + index"
                            value="Room description"
                            class="sr-only"
                        />
                        <textarea
                            :id="'room_description_' + index"
                            type="text"
                            v-model="room.room_description"
                            class="wb-input-box h-40 s:h-20"
                            required
                            :autocomplete="'room_description_' + index"
                            placeholder="This room is..."
                        />
                        <InputError :message="form.errors['rooms.' + index + '.room_description']" />
                        <ImageInput
                            v-model="room.room_image_primary"
                            :errorMessage="form.errors['rooms.' + index + '.room_image_primary']"
                            fieldTitle="room image"
                            :fieldID="'room_image_primary_' + index"
                            :originalImage="typeof(room.room_image_primary) === String ? room.room_image_primary : null"
                            notNullable
                        />

                        <div class="flex w-full justify-end pt-2">
                            <PlusOrCrossButton
                                v-on:click="removeRoom(index)"
                                text="Remove room"
                                isCross
                            />
                        </div>
                    </div>
                    <PlusOrCrossButton
                        v-on:click="addRoom"
                        text="Add room"
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
