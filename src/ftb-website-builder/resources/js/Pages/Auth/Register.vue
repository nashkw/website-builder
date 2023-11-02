<script setup>
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LoggedOutLayout from "@/Layouts/LoggedOutLayout.vue";
import ArrowIcon from "@/Components/Icons/ArrowIcon.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <LoggedOutLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="w-80 sm:w-96 my-7 bg-white bg-opacity-75 rounded-xl shadow-sm p-7 space-y-5">
                <div class="space-y-2 text-center mb-8">
                    <h1 class="wb-title">
                        Sign up
                    </h1>
                    <p class="wb-text">
                        Already have an account?
                        <Link
                            class="wb-text-link ml-1"
                            :href="route('login')"
                        >
                            Sign in here
                        </Link>
                    </p>
                </div>
                <div class="space-y-2">
                    <InputLabel
                        for="name"
                        value="Name"
                    />
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="email"
                        value="Email"
                    />
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="password"
                        value="Password"
                    />
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <div>
                    <button
                        type="submit"
                        class="wb-primary-button w-full mt-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Sign up
                        <ArrowIcon />
                    </button>
                </div>
            </div>
        </form>
    </LoggedOutLayout>
</template>
