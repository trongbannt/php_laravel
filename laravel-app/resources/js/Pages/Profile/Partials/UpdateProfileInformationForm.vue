<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const nameInput = ref(null);
const emailInput = ref(null);
const user = usePage().props.value.auth.user;
const form = useForm({
    name: user.name,
    email: user.email,
});


const updateProfileAccount = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.name) {
                form.reset('name');
                nameInput.value.focus();
            }
            if (form.errors.email) {
                form.reset('email');
                emailInput.value.focus();
            }
        },
    });
}


</script>
<template>
    <section>
        <header>
            <h3>Profile Information</h3>
            <p>Update your account's profile information and email address.</p>
        </header>

        <form @submit.prevent="updateProfileAccount">
            <div>
                <TextInput type="text" v-model="form.name" ref="nameInput" autofocus autocomplete="name"
                    placeholder="Name">
                </TextInput>
                <InputError v-if="form.errors.name" :message="form.errors.name">
                </InputError>
            </div>
            <div class="mt-3">
                <TextInput type="text" placeholder="Email" v-model="form.email" autocomplete="email"
                    ref="emailInput">
                </TextInput>
                <InputError v-if="form.errors.email" :message="form.errors.email">
                </InputError>
            </div>
            <div class="mt-3">
                <button type="submit" :disabled="form.processing" class="btn btn-secondary">Save</button>
                <span v-if="form.recentlySuccessful" class="text-success align-self-center pl-3"
                    id="status_upate_password">Saved success</span>
            </div>
        </form>
    </section>
</template>