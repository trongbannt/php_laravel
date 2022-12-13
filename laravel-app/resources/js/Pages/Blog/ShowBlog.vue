<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import moment from 'moment';
import { Inertia } from '@inertiajs/inertia'
import SearchSidebar from '@/Components/SearchSidebar.vue';


defineProps({
    blog: {},
    categories: Array,
});

</script>
<template>
    <MainLayout>

        <Head title="Home" />

        <section class="blog spad">
            <div class="container">
                <div class="row">
                    <SearchSidebar :categories=categories></SearchSidebar>

                    <div class="col-lg-8 col-md-7 order-md-1 order-1">
                        <div class="blog__details__text">
                            <h2>{{ blog.name }}</h2>
                            <div class="mt-5">
                                <img v-for="image in blog.blog_images" :src="'/images/' + image.image_path" alt="">
                            </div>
                            <section>
                                <p v-html="blog.content"></p>
                            </section>


                        </div>
                    </div>
                </div>
            </div>
        </section>

    </MainLayout>
</template>
