<script setup>
import AccountFormDelete from './AccountFormDelete.vue';
import AccountFormPassword from './AccountFormPassword.vue';
import AccountFormInfo from './AccountFormInfo.vue';
import LoggedInLayout from "@/Layout/LoggedInLayout.vue";
import AppHead from "@/Layout/AppHead.vue";
import AccountFormSubdomain from "@/Pages/Account/AccountFormSubdomain.vue";

const props = defineProps({
    subdomain: String,
});
</script>

<template>
    <AppHead title="Account" />
    <LoggedInLayout>
        <h1 class="wb-title">
            Manage your account
        </h1>
        <AccountFormInfo class="wb-card" />
        <AccountFormSubdomain
            class="wb-card"
            :subdomain="subdomain"
        />
        <AccountFormPassword class="wb-card" />
        <AccountFormDelete class="wb-card" />
    </LoggedInLayout>
</template>
