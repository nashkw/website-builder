<script setup>
import { Link } from '@inertiajs/vue3';
import UserIcon from "@/Components/Icons/UserIcon.vue";
</script>

<template>
    <Link
        v-if="$page.props.auth.user"
        :href="route('logout')"
        method="post"
        as="button"
        class="wb-secondary-button"
    >
        <UserIcon />
        Sign out
    </Link>
    <Link
        v-else
        :href="route('login')"
        class="wb-secondary-button"
    >
        <UserIcon />
        Sign in
    </Link>
</template>
