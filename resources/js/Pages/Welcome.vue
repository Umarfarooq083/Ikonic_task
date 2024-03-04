<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div>
        <div v-if="canLogin" class="center">
    <Link v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</Link>
    <template v-else>
        <div class="login-register-links">
            <Link :href="route('login')">Log in</Link>
            <Link v-if="canRegister" :href="route('register')">Register</Link>
        </div>
    </template>
</div>
    </div>
</template>

<style>
  .center {
    text-align: center;
  }
  .login-register-links {
    margin-top: 20px;
  }
  a {
    display: inline-block;
    margin: 0 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  a:hover {
    background-color: #0056b3;
  }
</style>