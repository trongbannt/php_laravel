<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import { Head, Link, useForm, progress, usePage } from '@inertiajs/inertia-vue3';
import { ref, onUpdated } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLable from '@/Components/InputLabel.vue';

const notification = ref(false);

const props = defineProps({
    categories: [],
});

const form = useForm({
    name: '',
    image: null,
    count: null,
    category_id: null,
    description: '',
});

onUpdated(() => {
    if (usePage().props.value.flash) {
        notification.value = true;
        setTimeout(function () {
            notification.value = false;
        }, 3000);
    }
});

const CreateFood = () => {
    const url = route('foods.store');
    form.post(url,{
        forceFormData: true,
        onError: e => { console.log('onError', e); },
        onFinish: () => {
            form.reset();
        },
    });
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

        <Head title="Create food"></Head>
        <div>
            <div class="mt-3 mb-3">
                <h1>Create item food</h1>
            </div>

            <form @submit.prevent="CreateFood">
                <div class="form-group mb-3">
                    <InputLable>Name</InputLable>
                    <TextInput type="text" v-model="form.name" autofocus placeholder="Enter food's name"></TextInput>
                    <InputError v-if="form.errors.name" :message="form.errors.name">
                    </InputError>
                </div>

                <!--image-->
                <div class="form-group mb-3">
                    <img v-if="form.image" id="show_image" class="img-thumbnail" width="200"
                        height="200">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Choice image for food</span>
                    </div>
                    <div class="custom-file">
                        <label for="input_file_image" id="name_image" class="name-image-food">Choose file</label>
                        <input type="file" id="input_file_image" class="custom-file-input" name="image"
                            @input="form.image = $event.target.files[0]" @change="updateImage"
                            accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <InputError v-if="form.errors.image" :message="form.errors.image"></InputError>


                <div class="form-group mb-3">
                    <InputLable>Count</InputLable>
                    <TextInput type="number" v-model="form.count" placeholder="Enter food's count"></TextInput>
                    <InputError v-if="form.errors.count" :message="form.errors.count"></InputError>
                </div>

                <div class="form-group mb-3">
                    <label for="category_id">Category</label>
                    <select class="custom-select" v-model="form.category_id">
                        <option selected>--Choose a categories--</option>
                        <option v-for="category in categories" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                    <InputError v-if="form.errors.category_id" :message="form.errors.category_id"></InputError>
                </div>

                <div class="form-group mb-3">
                    <InputLable>Description</InputLable>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        placeholder="Enter food's description" v-model="form.description"></textarea>
                </div>

                <button type="submit" :disabled="form.processing" class="btn btn-primary mb-3 mr-1"
                    value="">Save</button>
                <Link :href="route('foods.index')" class="btn btn-secondary mb-3" value="">Back</Link>
                <div>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
                </div>
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