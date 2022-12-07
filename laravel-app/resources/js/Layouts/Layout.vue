<script setup>
import { Link } from '@inertiajs/inertia-vue3';


</script>

<template>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand active" href="/">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link "
                                href="/products">Products
                               </a>
                        </li>
                        <li class="nav-item" v-if="$page.props.auth.user">
                            <a class="nav-link "  href="/posts">Posts</a>
                        </li>
                        <li class="nav-item" v-if="$page.props.auth.user">
                            <Link class="nav-link" :href="route('foods.index')">Foods</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="route('about')"> About</Link>
                        </li>

                        <li class="nav-item dropdown" v-if="$page.props.auth.user">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>
                                    <i class="bi bi-person-fill-gear" style="font-size: 0.75rem; color:#ffff"></i>
                                    <!-- Show user name  -->
                                    {{ $page.props.auth.user.name }}        
                                </span>

                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <Link class="dropdown-item" :href="route('profile.edit')">Profile</Link>
                                <!-- logout -->
                                <Link method="POST" class="dropdown-item" as="button" type="button" :href="route('logout')">Logout</Link>
                                <!--end logout -->
                            </div>
                        </li>
                        <!-- not yet login -->
                        <li class="nav-item dropdown" v-if="!$page.props.auth.user">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-fill-gear" style="font-size: 0.75rem; color:#ffff"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <Link class="dropdown-item" :href="route('login')">Login</Link>
                                <Link class="dropdown-item" :href="route('register')">Register</Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Page Content -->
    <main>
        <div class="container"> 
            <slot/>
        </div>
    </main>
    <footer class="text-center text-white" style="background-color: #caced1;">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
</template>
<style>
.nav-link{
    margin-top: 0.15rem !important;
}
</style>
