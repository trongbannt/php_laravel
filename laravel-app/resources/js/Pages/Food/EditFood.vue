<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    food: {},
    categories: []
});

const form = useForm({
    name: '',
    image_path: '',
    count: '',
    category_id: '',
    description: ''

});

const updateFood = () => {
    console.log(this.food);
}

onMounted(()=>{
   console.log(this.food);
})

</script>
<template>
    <MainLayout>

        <Head title="Show food detail"></Head>
        <div>
            <div class="mt-3 mb-3">
                <h1>Modify item food</h1>
            </div>
            {{ food }}
            <form @submit.prevent="updateFood">

                <div class="form-group mb-3">
                    <label for="title">Name</label>
                    <input type="text" class="form-control"  v-model="food.name" id="name" name="name"
                        placeholder="Enter food's name">
                </div>
             
                <button type="submit" class="btn btn-primary mb-3 mr-1" value="">Save</button>
                <Link :href="route('foods.index')" class="btn btn-secondary mb-3" value="">Back</Link>
            </form>
        </div>
    </MainLayout>
</template>

<style>
.name-image-food {
    position: absolute;
    top: 0;
    /* right: 0; */
    left: 0;
    z-index: 1;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

.input-group>.custom-file:not(:first-child) .name-image-food {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
</style>