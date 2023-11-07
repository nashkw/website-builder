<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import LoggedInLayout from "@/Layouts/LoggedInLayout.vue";

defineProps({
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Account" />
    <LoggedInLayout>
        <h1 class="wb-title text-center">Manage your account</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 sm:wb-bg sm:rounded-lg">
                <UpdateProfileInformationForm
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div class="p-4 sm:p-8 sm:wb-bg sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 sm:wb-bg sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </LoggedInLayout>
</template>
