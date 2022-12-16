<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref, onUpdated } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLable from '@/Components/InputLabel.vue';

const notification = ref(false);

const props = defineProps({
    food: {},
    categories: Array,
    errors: {},
});

const form = useForm({
    name: props.food.name,
    image: null,
    image_path: props.food.image_path,
    count: props.food.count,
    category_id: props.food.category_id,
    description: props.food.description,
});

onUpdated(() => {
    if (usePage().props.value.flash.success) {
        notification.value = true;
        setTimeout(function () {
            notification.value = false;
        }, 3000);
    }
});

const updateFood = () => {
    const url = route('foods.update', { 'id': props.food.id });
    Inertia.post(url, {
        _method: 'put',
        forceFormData: true,
        image: form.image,
        name: form.name,
        count: form.count,
        image_path: form.image_path,
        category_id: form.category_id,
        description: form.description,
    })
}

const updateImage = (e) => {
    const showImage = document.getElementById('show_image');
    const nameImage = document.getElementById('name_image');
    showImage.setAttribute('src', window.URL.createObjectURL(e.target.files[0]));
    nameImage.innerHTML = e.target.files[0].name;
}

</script>
<template>
    <MainLayout>

        <Head title="Show food detail"></Head>
        <div>
            <div class="mt-4 mb-3">
                <h1>Modify item food</h1>
            </div>

            <div v-if="notification" class="alert alert-danger" role="alert">
                {{ usePage().props.value.flash.message }}
            </div>

            <form @submit.prevent="updateFood">
                <div class="form-group mb-3">
                    <InputLable>Name</InputLable>
                    <TextInput type="text" v-model="form.name" autofocus placeholder="Enter food's name"></TextInput>
                    <InputError v-if="errors.name" :message="errors.name">
                    </InputError>
                </div>

                <!--image-->
                <div class="form-group mb-3" v-if="food.image_path">
                    <img :src="'/images/' + food.image_path" id="show_image" class="img-thumbnail" width="200"
                        height="200">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Change image</span>
                    </div>
                    <div class="custom-file">
                        <label for="input_file_image" id="name_image" class="name-image-food">Choose file</label>
                        <input type="file" id="input_file_image" class="custom-file-input" name="image"
                            @input="form.image = $event.target.files[0]" @change="updateImage" accept="image/*">
                    </div>
                </div>
                <InputError v-if="errors.image" :message="errors.image"></InputError>


                <div class="form-group mb-3">
                    <InputLable>Count</InputLable>
                    <TextInput type="number" v-model="form.count" placeholder="Enter food's count"></TextInput>
                    <InputError v-if="errors.count" :message="errors.count"></InputError>
                </div>

                <div class="form-group mb-3">
                    <label for="category_id">Category</label>
                    <select class="custom-select" v-model="form.category_id">
                        <option value="">--Choose a categories--</option>
                        <option v-for="category in categories" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                    <InputError v-if="errors.category_id" :message="errors.category_id"></InputError>
                </div>

                <div class="form-group mb-3">
                    <span>
                        <InputLable>Description</InputLable>
                        <Link :href="route('blog.create',{'food_id':props.food.id})" class="btn ml-1" value="">
                        <span> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Write Detail</span>
                        </Link>
                    </span>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        placeholder="Enter food's description" v-model="form.description"></textarea>
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

.custom-file-input {
    width: 0% !important;
}
</style>