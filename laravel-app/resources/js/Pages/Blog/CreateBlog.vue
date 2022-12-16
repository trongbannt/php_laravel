<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import { Head,Link, useForm,usePage } from '@inertiajs/inertia-vue3';
import { ref,onUpdated } from 'vue'
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLable from '@/Components/InputLabel.vue';
// Basic Use - Covers most scenarios
import { VueEditor } from "vue3-editor";
import axios from "axios";

const images = ref([]);
const notification = ref(false);

const props = defineProps({
    food: {},
    blog:{}
});

const form = useForm({
    id: props.blog.id,
    name: props.blog.name,
    food_id: props.food.id,
    content: props.blog.content,
});

onUpdated(() => {
    debugger;
    if (usePage().props.value.flash.success) {
        notification.value = true;
        setTimeout(function () {
            notification.value = false;
        }, 3000);
    }
});

const saveContent = () => {
    const url = route('blog.save', { 'food_id': form.food_id });
    form.post(url, {
        forceFormData: true,
        preserveState: false,
        preserveScroll: false,
        onSuccess: result => {
            console.log(result);
        },
        onError: e => { console.log('onError', e); },
        onFinish: () => {
            form.reset();
        },
    });
}

const handleImageAdded = function (file, Editor, cursorLocation, resetUploader) {
    var formData = new FormData();
    formData.append("image", file);
    formData.append("food_id", props.food.id);
    var url = route("blog.uploadImage");
    axios({
        url: url,
        method: "post",
        data: formData
    }).then(result => {
        const url = result.data.url; // Get url from response
        images.value.push(result.data);
        Editor.insertEmbed(cursorLocation, "image", url);
        resetUploader();
    }).catch(err => {
        console.log(err);
    });
}


</script>
<template>
    <MainLayout>

        <Head title="Write blog for product" />
        <section class="blog mt-5">
            <div class="container">
                <div v-if="notification" class="alert alert-success" role="alert">
                    {{ usePage().props.value.flash.success }}
                </div>
                <form @submit.prevent="saveContent">
                    <div class="form-group mb-3">
                        <InputLable>Name blog</InputLable>
                        <TextInput type="text" v-model="form.name" autofocus placeholder="Enter blog's name">
                        </TextInput>
                        <InputError v-if="form.errors.name" :message="form.errors.name">
                        </InputError>
                    </div>
                    <div class="form-group mb-3">
                        <InputLable>Name food</InputLable>
                        <TextInput type="text" :value="food.name" readonly placeholder="Food's name"></TextInput>

                    </div>
                    <div>
                        <div class="form-group mb-3">
                            <InputLable>Content</InputLable>
                            <vue-editor id="editor" useCustomImageHandler @imageAdded="handleImageAdded"
                                v-model="form.content">
                            </vue-editor>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mb-5">Save</button>
                        <Link :href="route('foods.edit', { 'id': props.food.id })" class="btn btn-secondary ml-2 mb-5"
                            value="">Back</Link>
                    </div>
                </form>
            </div>
        </section>

    </MainLayout>
</template>
