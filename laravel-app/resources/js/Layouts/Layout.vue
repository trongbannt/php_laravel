<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" 
            style="background-color: #7fad39 !important;">
            <div class="container container-fluid">
                <a class="navbar-brand active" href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" v-if="$page.props.auth.user">
                            <a class="nav-link "  href="/posts"><i class="fa fa-rss" aria-hidden="true"></i> Posts</a>
                        </li>
                        <li class="nav-item" v-if="$page.props.auth.user">
                            <Link class="nav-link" :href="route('foods.index')" :class="{ 'active': $page.url.startsWith('/foods') }"><i class="fa fa-cutlery" aria-hidden="true"></i> Foods</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :href="route('contact')" :class="{ 'active': $page.url.startsWith('/contact') }"><i class="fa fa-compress" aria-hidden="true"></i> Contact</Link>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown mr-auto" v-if="$page.props.auth.user">
                            <a class="nav-link dropdown-toggle active"  id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>
                                    <!-- <i class="bi bi-person-fill-gear" style="font-size: 0.75rem; color:#ffff"></i> -->
                                    <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
                                    <!-- Show user name  -->
                                    {{ $page.props.auth.user.name }}        
                                </span>

                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <Link class="dropdown-item" :href="route('profile.edit')"><i class="fa fa-user" aria-hidden="true"></i> Profile</Link>
                                <!-- logout -->
                                <Link method="POST" class="dropdown-item" as="button" type="button" :href="route('logout')"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</Link>
                                <!--end logout -->
                            </div>
                        </li>
                        <li class="nav-item dropdown mr-auto" v-if="$page.props.auth.user">
                            <a class="nav-link dropdown-toggle active"  id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i class=" fa fa-solid fa-gears"></i> Roles</span>

                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <span class="dropdown-item" v-for="item in $page.props.auth.role">{{item.name}}</span>
                            </div>
                        </li>
                        <!-- not yet login -->
                        <li class="nav-item dropdown" v-if="!$page.props.auth.user">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i> 
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

.dropdown-item.active, .dropdown-item:active {
    color: #16181b;
    text-decoration: none;
    background-color: #e9ecef;
}
</style>
