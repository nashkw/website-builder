<script setup>
import AccountFormDelete from './AccountFormDelete.vue';
import AccountFormPassword from './AccountFormPassword.vue';
import AccountFormInfo from './AccountFormInfo.vue';
import { Head } from '@inertiajs/vue3';
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
</script>

<template>
    <Head title="Account" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Manage your account
        </h1>
        <AccountFormInfo class="wb-card" />
        <AccountFormPassword class="wb-card" />
        <AccountFormDelete class="wb-card" />
    </LoggedInLayout>
</template>
