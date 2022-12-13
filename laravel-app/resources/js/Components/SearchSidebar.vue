<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia'

const filter = ref(null);
defineProps({
    categories: Array,
});

const searchFood = () => {
    Inertia.get(route('home', { 'filter': filter.value }))
}

</script>
<template>
    <div class="col-lg-4 col-md-5">
        <div class="blog__sidebar">
            <div class="blog__sidebar__search">
                <input type="text" placeholder="Search..." @keyup.enter="searchFood" v-model="filter">
                <button @click="searchFood"><span><i class="bi bi-search"></i></span></button>
            </div>

            <div class="blog__sidebar__item">
                <h4>Categories</h4>
                <ul>
                    <li>
                        <Link :href="route('home')">All</Link>
                    </li>
                    <li v-for="category in categories">
                        <Link :href="route('home', { 'category': category.id })">{{ category.name }}</Link>
                    </li>
                </ul>
            </div>
            <div class="blog__sidebar__item">
                <h4>Recent News</h4>
                <div class="blog__sidebar__recent">
                    <a href="#" class="blog__sidebar__recent__item">
                        <div class="blog__sidebar__recent__item__pic">
                            <img src="/blog/sidebar/sr-1.jpg" alt="">
                        </div>
                        <div class="blog__sidebar__recent__item__text">
                            <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                            <span>MAR 05, 2019</span>
                        </div>
                    </a>
                    <a href="#" class="blog__sidebar__recent__item">
                        <div class="blog__sidebar__recent__item__pic">
                            <img src="/blog/sidebar/sr-2.jpg" alt="">
                        </div>
                        <div class="blog__sidebar__recent__item__text">
                            <h6>Tips You To Balance<br /> Nutrition Meal Day</h6>
                            <span>MAR 05, 2019</span>
                        </div>
                    </a>
                    <a href="#" class="blog__sidebar__recent__item">
                        <div class="blog__sidebar__recent__item__pic">
                            <img src="/blog/sidebar/sr-3.jpg" alt="">
                        </div>
                        <div class="blog__sidebar__recent__item__text">
                            <h6>4 Principles Help You Lose <br />Weight With Vegetables</h6>
                            <span>MAR 05, 2019</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="blog__sidebar__item">
                <h4>Search By</h4>
                <div class="blog__sidebar__item__tags">
                    <a href="#">Apple</a>
                    <a href="#">Beauty</a>
                    <a href="#">Vegetables</a>
                    <a href="#">Fruit</a>
                    <a href="#">Healthy Food</a>
                    <a href="#">Lifestyle</a>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.blog__sidebar__search {
    margin-bottom: 50px;
}

.blog__sidebar__search {
    position: relative;
}

.blog__sidebar__search input {
    width: 100%;
    height: 46px;
    font-size: 16px;
    color: #6f6f6f;
    padding-left: 15px;
    border: 1px solid #e1e1e1;
    border-radius: 20px;
}

.blog__sidebar__search input::placeholder {
    color: #6f6f6f;
}

.blog__sidebar__search button {
    font-size: 16px;
    color: #6f6f6f;
    background: transparent;
    border: none;
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    padding: 0px 18px;
}
</style>