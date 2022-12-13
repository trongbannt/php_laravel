<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import Modal from '@/Components/Modal.vue'
import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
import Paginate from 'vuejs-paginate-next';
import { ref, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia'

const notification = ref(false);
const confirmingUserDeletion = ref(false);
const foodDelete = ref(null);
const filter = ref(null);

defineProps({
    foods: {},
    prev:null, // fix warning
    next:null // fix warning
});

onMounted(() => {
    if (usePage().props.value.flash.message || usePage().props.value.flash.notification) {
        notification.value = true;
        setTimeout(function () {
            notification.value = false;
        }, 3000);
    }
});

const searchFood = () => {
    Inertia.get(route('foods.index', { 'filter': filter.value }))
}

const closeModal = () => {
    confirmingUserDeletion.value = false;
    const element = document.getElementsByClassName("modal-open");
    element[0].classList.remove("modal-open");
    const collection = document.getElementsByClassName("modal-backdrop fade show");
    collection[0].remove();
}

const confirmUserDeletion = (id) => {
    confirmingUserDeletion.value = true;
    var lstFood = usePage().props.value.foods.data;
    foodDelete.value = lstFood.find(item => item.id == id);
}

const deleteFood = () => {
    Inertia.delete(route('foods.destroy', { 'id': foodDelete.value.id }), {
        preserveState: false,
        preserveScroll: false,
        onSuccess: () => { closeModal(); },
    })
}


//When next page
const clickCallback = function (pageNum) {
    var params = {
        'page': pageNum
    }
    if (route().params.filter) {
        params.filter = route().params.filter
    }
    this.$inertia.visit(route('foods.index', params), {
        method: 'get',
        preserveState: true,
        preserveScroll: true,
    })
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


</script>
<template>
    <MainLayout>

        <Head title="Foods"></Head>

        <div class="mt-4">
            <div v-if="notification">
                <div v-if="usePage().props.value.flash.notification">
                    <div v-if="usePage().props.value.flash.notification.status == 'success'" class="alert alert-success"
                        role="alert">
                        {{ usePage().props.value.flash.notification.message }}
                    </div>
                    <div v-else-if="usePage().props.value.flash.notification.status == 'error'" class="alert alert-danger"
                        role="alert">
                        {{ usePage().props.value.flash.notification.message }}
                    </div>
                </div>
                <div v-else class="alert alert-success" role="alert">
                    {{ usePage().props.value.flash.message }}
                </div>
            </div>

            <div class="d-flex flex-row mb-3">
                <div class="mr-auto">
                    <Link :href="route('foods.create')" type="button" class="btn btn-primary">Add food</Link>
                </div>
                <div>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <div class="input-group-text bg-transparent border-right-0"><i class="bi bi-search"></i>
                            </div>
                        </span>
                        <input class="form-control py-2 border-left-0 border" type="search" v-model="filter"
                            @keyup.enter="searchFood" placeholder="Search..." id="example-search-input">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary border-left-0 border" type="button"
                                @click="searchFood">
                                Search
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive-md">
                <table class="table table-hover">
                    <thead class="text-center">
                        <tr class="">
                            <th class="col-1" scope="col">#</th>
                            <th class="col-2 text-center" scope="col">Name</th>
                            <th class="col-1" scope="col">Count</th>
                            <th class="col-3" scope="col">Description</th>
                            <th class="col-3" scope="col">Category</th>
                            <th class="col-1" scope="col"></th>
                            <th class="col-1 text-left" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="(food, index) in foods.data">
                            <td>{{ (index + 1 + ((foods.current_page - 1) * foods.per_page)) }}</td>
                            <td>
                                <Link :href="(route('foods.show', { 'id': food.id }))">{{ food.name }}</Link>
                            </td>
                            <td>{{ food.count }}</td>
                            <td>{{ food.description }}</td>
                            <td>{{ food.category.name }}</td>
                            <td class="text-right" style="padding-right: 0">
                                <Link :href="(route('foods.edit', { 'id': food.id }))" class="btn btn-primary">Edit
                                </Link>
                            </td>
                            <td class="text-left">
                                <a class="btn btn-danger delete_food " @click="confirmUserDeletion(food.id)"
                                    data-toggle="modal" data-target="#exampleModal">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="(foods.total > foods.per_page)" class="d-flex align-items-center">
                <span class="mr-auto text-muted">Showing {{ foods.from }} to {{ foods.to }} of {{ foods.total }}
                    results</span>
                <div class="align-self-center">
                    <paginate :v-model="foods.current_page" :page-count="getPageCount(foods.total, foods.per_page)"
                        :container-class="'pagination justify-content-end pt-1'" :prev-text="prev" :next-text="next"
                        :click-handler="clickCallback" :page-class="'page-item'" :page-link-class="'page-link'"
                        :prev-class="'prev-item'" :prev-link-class="'page-link prev-link-item'"
                        :next-class="'next-item'" :next-link-class="'page-link next-link-item'"
                        :break-view-class="'break-view'" :break-view-link-class="'break-view-link'"
                        :first-last-button="false">
                    </paginate>
                </div>

            </div>
        </div>
        <!--Modal-->
        <Modal :show=confirmingUserDeletion modalId="exampleModal">
            <template #header>
                <span>Confirm</span>
            </template>
            <template #body>
                <div>
                    <p class="font-weight-bold">Are you sure your want to delete your account?</p>
                    <div v-if="foodDelete" class=" font-italic">
                        <p class="mb-1"><span>&#9755;</span> {{ foodDelete.name }}</p>
                        <p class="mb-1"><span>&#9755;</span> {{ foodDelete.category.name }}</p>
                        <p class="mb-1" v-if="foodDelete.description"><span>&#9755;</span> {{ foodDelete.description }}
                        </p>
                    </div>
                </div>
            </template>
            <template #footer>
                <div>
                    <button type="button" class="btn btn-light mr-2" @click="closeModal"
                        data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-danger" @click="deleteFood">DELETE</button>
                </div>
            </template>
        </Modal>
    </MainLayout>
</template>