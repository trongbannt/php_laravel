<script setup>
import MainLayout from '../Layouts/Layout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
 
});
</script>
<template>
    <MainLayout>
        <Head title="Home-App" />
        <h1>This page home</h1>
        <h3 v-if="$page.props.auth.user">You're logged in! {{ $page.props.auth.user.name }}</h3>
    </MainLayout>
</template>