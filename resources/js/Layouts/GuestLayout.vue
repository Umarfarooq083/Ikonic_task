<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-3 pt-sm-0 bg-light">
        <div>
            <Link href="/">
                <!-- Assuming ApplicationLogo can accept Bootstrap classes directly or you adjust its internal styling accordingly -->
                <ApplicationLogo class="w-20 h-20 text-secondary" />
            </Link>
        </div>

        <div class="w-100 mt-3 px-3 py-4 bg-white shadow-sm overflow-hidden rounded-lg" style="max-width: 32rem;">
            <slot />
        </div>
    </div>
</template>
