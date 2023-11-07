<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import LoggedInLayout from "@/Layouts/LoggedInLayout.vue";
</script>

<template>
    <Head title="Account" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Manage your account
        </h1>
        <UpdateProfileInformationForm class="wb-card" />
        <UpdatePasswordForm class="wb-card" />
        <DeleteUserForm class="wb-card" />
    </LoggedInLayout>
</template>
