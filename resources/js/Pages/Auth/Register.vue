<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

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
    <Head title="Register" />
    
    <div class="min-h-screen flex justify-center items-center bg-gray-100">
        <div class="max-w-md w-full px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-2xl font-semibold mb-6 text-center">Registration Page</h1>
            <form @submit.prevent="submit">
                <div>
                    <label for="name" class="block mb-2">Name</label>
                    <input
                        id="name"
                        type="text"
                        class="form-input w-full"
                        v-model="form.name"
                        autofocus
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <label for="email" class="block mb-2">Email</label>
                    <input
                        id="email"
                        type="email"
                        class="form-input w-full"
                        v-model="form.email"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block mb-2">Password</label>
                    <input
                        id="password"
                        type="password"
                        class="form-input w-full"
                        v-model="form.password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block mb-2">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        class="form-input w-full"
                        v-model="form.password_confirmation"
                        autocomplete="new-password"
                    />
                </div>

                <div class="flex justify-between items-center mt-6">
                    <Link
                        :href="route('login')"
                        class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring focus:ring-gray-400"
                    >
                        Already registered? Log in.
                    </Link>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
