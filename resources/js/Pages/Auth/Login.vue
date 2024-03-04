<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

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
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>


<template>
    <Head title="Login" />
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-3 pt-sm-0 bg-light">
        <div class="w-100 mt-3 px-3 py-4 bg-white shadow-sm overflow-hidden rounded-lg" style="max-width: 32rem;">
            <h1 class="text-2xl font-semibold mb-6 text-center">Login Page</h1>

            <span v-show="form.errors" style="color:red">{{form.errors.message}}</span>
            <form @submit.prevent="submit">
            <div>
                <lable>Email</lable>
                <input
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="form.email"
                    required
                />
                <span v-show="form.errors" style="color:red">{{form.errors.email}}</span>
            </div>

            <div class="mt-4">
                <lable>Password</lable>
                <input
                    id="password"
                    type="password"
                    class="form-control"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
                <span v-show="form.errors" style="color:red">{{form.errors.password}}</span>
               
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
        </div>
    </div>

</template>


