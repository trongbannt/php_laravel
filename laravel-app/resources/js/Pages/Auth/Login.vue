<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import LogoLogin from '../../Components/LogoLogin.vue';


const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <Head title="Log in" />
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card my-5">

                        <!--Form login-->
                        <form class="card-body cardbody-color p-lg-5" @submit.prevent="submit">
                            <LogoLogin></LogoLogin>

                            <div class="mb-3">
                                <input type="email" v-model="form.email" id="email" class="form-control"
                                    :class="[form.errors.email ? 'is-invalid' : '']" placeholder="Email">
                                <div class="text-danger" v-show="form.errors.email">{{ form.errors.email }}</div>
                            </div>
                            <div class="mb-3">
                                <input type="password" id="password" v-model="form.password" class="form-control"
                                    :class="[form.errors.password ? 'is-invalid' : '']" placeholder="Password">
                                <div class="text-danger" v-show="form.errors.password">{{ form.errors.password }}</div>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" style="margin-top: 0.45rem" type="checkbox" value="true"
                                    id="remember" v-model="form.remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                            <div class="text-center"><button type="submit"
                                    class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                            <div class="form-text text-center text-dark">Not
                                Registered? <a :href="route('register')" class="text-dark fw-bold"> Create an
                                    Account</a>
                            </div>
                            <div class="form-text text-center mb-5 text-dark">
                                <a href="/" class="text-dark fw-bold">Home</a>
                            </div>
                        </form>
                        <!--End form login-->
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