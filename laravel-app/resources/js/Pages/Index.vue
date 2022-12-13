<script setup>
import MainLayout from '../Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Paginate from 'vuejs-paginate-next';
import moment from 'moment';
import SearchSidebar from '@/Components/SearchSidebar.vue';

defineProps({
    foods: {},
    categories: Array,
    prev: null, // fix warning
    next: null // fix warning
});


const format_date = (value) => {
    if (value) {
        return moment(String(value)).format('MMM D, YYYY')
    }
}

const getPageCount = (total, pageSize) => {
    var pageCount = 0;
    if ((total % pageSize) > 0) {
        pageCount = Math.floor(total / pageSize) + 1;
    }
    else {
        pageCount = Math.floor(total / pageSize);
    }

    return pageCount;
}

//When next page
const clickCallback = function (pageNum) {
    var query = {
        'page': pageNum
    }
    if (route().params.filter) {
        query.filter = route().params.filter
    }
    if (route().params.category) {
        query.category = route().params.category
    }

    this.$inertia.visit(route('home', query), {
        method: 'get',
        preserveState: true,
        preserveScroll: false,
    })
}

</script>
<template>
    <MainLayout>

        <Head title="Home" />

        <section class="blog spad">
            <div class="container">
                <div class="row">
                    <SearchSidebar :categories=categories></SearchSidebar>

                    <div class="col-lg-8 col-md-7">
                        <div class="row">
                            <div v-for="(food, index) in foods.data" class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img :src="'/images/' + food.image_path" :alt=food.name height="200"
                                            width="200">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{ format_date(food.created_at) }}</li>
                                            <li><i class="fa fa-bell-o"></i> {{ food.count }}</li>
                                        </ul>
                                        <h5><Link :href="route('blog.food', { 'food_id': food.id })">{{ food.name }}</Link></h5>
                                        <p>{{ food.description }}</p>
                                        <Link class="blog__btn" :href="route('blog.food', { 'food_id': food.id })">
                                            <span>READ MORE <i class="fa fa-thin fa-arrow-right"></i></span>
                                        </Link>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div v-if="(foods.total > foods.per_page)" class="align-items-center d-flex">
                                    <p class="mr-auto">
                                        <span class="text-muted">Showing {{ foods.from }} to {{ foods.to }} of
                                            {{ foods.total }} results</span>
                                    </p>
                                    <div class="">
                                        <paginate :v-model="foods.current_page"
                                            :page-count="getPageCount(foods.total, foods.per_page)"
                                            :container-class="'pagination justify-content-end pt-1'" :prev-text="prev"
                                            :next-text="next" :click-handler="clickCallback" :page-class="'page-item'"
                                            :page-link-class="'page-link'" :prev-class="'prev-item'"
                                            :prev-link-class="'page-link prev-link-item'" :next-class="'next-item'"
                                            :next-link-class="'page-link next-link-item'"
                                            :break-view-class="'break-view'" :break-view-link-class="'break-view-link'"
                                            :first-last-button="false">
                                        </paginate>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </MainLayout>
</template>
<style>
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #7fad39;
    border-color: #7fad39;
}

.page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #b2b2b2;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.page-link:hover {
    z-index: 2;
    text-decoration: none;
    color: #fff;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

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