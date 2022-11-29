<script setup>
import { Head, useForm,Link } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import LogoLogin from '@/Components/LogoLogin.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const submit = () => {
    form.post(route('register'))
};

</script>
<template>
    <Head title="Register user"></Head>
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card my-5">

                        <!--Form register user-->
                        <form @submit.prevent="submit" class="card-body cardbody-color p-lg-5">
                            <LogoLogin></LogoLogin>

                            <div class="mb-3">
                                <TextInput type="text" id="name" placeholder="Name" v-model="form.name" autofocus />
                                <InputError :message="form.errors.name"></InputError>
                            </div>
                            <div class="mb-3">
                                <TextInput type="email" id="email" placeholder="Email" v-model="form.email" />
                                <InputError :message="form.errors.email"></InputError>
                            </div>
                            <div class="mb-3">
                                <TextInput type="password" id="password" placeholder="Password"
                                    v-model="form.password" />
                                <InputError :message="form.errors.password"></InputError>
                            </div>
                            <div class="mb-3">
                                <TextInput type="password" id="password_confirmation" placeholder="Confirm Password"
                                    v-model="form.password_confirmation" />
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-color px-5 mb-5 w-100">Register</button>
                            </div>
                            <div class="form-text text-center text-dark">
                                <Link :href="route('login')" class="text-dark fw-bold">Already registered?</Link>
                            </div>
                            <div class="form-text text-center mb-5 text-dark">
                                <Link :href="route('home')" class="text-dark fw-bold">Home</Link>
                            </div>
                        </form>
                        <!--End form register user-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.btn-color {
    background-color: #0e1c36;
    color: #fff;
}

.btn-color:hover {
    background-color: #0e1c36;
    color: #fff;

}

.profile-image-pic {
    height: 200px;
    width: 200px;
    object-fit: cover;
}

.cardbody-color {
    background-color: #ebf2fa;
}

a {
    text-decoration: none;
}
</style>