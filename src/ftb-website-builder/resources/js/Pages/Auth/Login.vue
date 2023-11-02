<script setup>
import Checkbox from '@/Components/Forms/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/Forms/InputError.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LoggedOutLayout from "@/Layouts/LoggedOutLayout.vue";
import ArrowIcon from "@/Components/Icons/ArrowIcon.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <LoggedOutLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="w-80 sm:w-96 my-7 bg-white rounded-xl shadow-sm p-7 space-y-5">
                <div class="space-y-2 text-center mb-8">
                    <h1 class="wb-title">
                        Sign in
                    </h1>
                    <p class="wb-text">
                        Dont have an account?
                        <Link
                            class="wb-text-link ml-1"
                            :href="route('register')"
                        >
                            Sign up here
                        </Link>
                    </p>
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
                        autofocus
                        autocomplete="username"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <InputLabel
                            for="password"
                            value="Password"
                        />
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="wb-text-link text-sm"
                        >
                            Forgot your password?
                        </Link>
                    </div>
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="block">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 wb-text">Remember me</span>
                    </label>
                </div>

                <div>
                    <button
                        type="submit"
                        class="wb-primary-button w-full mt-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Sign in
                        <ArrowIcon />
                    </button>
                </div>
            </div>
        </form>
    </LoggedOutLayout>
</template>
