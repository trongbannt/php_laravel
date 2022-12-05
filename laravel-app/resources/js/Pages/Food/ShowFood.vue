<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    food:{}
});

</script>
<template>
    <MainLayout>

        <Head title="Show food detail"></Head>
        <div>
            <div class="mt-3 mb-3">
                <h1>Show food detail</h1>
            </div>
            <div>
                <Link :href="route('foods.index')" class="btn btn-secondary mb-3" value="">Back</Link>
                <div class="form-group mb-3">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" disabled :value="food.name" id="name" name="name">
                </div>
                <div class="form-group mb-3">
                    <label for="title">Count</label>
                    <input type="text" class="form-control" disabled :value="food.count" id="count" name="count">
                </div>
                <div class="form-group mb-3">
                    <label for="title">Category</label>
                    <input type="text" class="form-control" disabled :value="food.category.name" id="category"
                        name="category">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" disabled name="description"
                        rows="3">{{ food.description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <img v-if="food.image_path" :src="'/images/' + food.image_path" class="img-thumbnail" width="200" height="200">
                </div>
            </div>
        </div>
    </MainLayout>
</template>