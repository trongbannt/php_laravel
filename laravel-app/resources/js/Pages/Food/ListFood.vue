<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import Modal from '@/Components/Modal.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Paginate from 'vuejs-paginate-next';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia'

defineProps({
    foods: [],
});

const confirmingUserDeletion = ref(false);
const foodDelete = ref(null);


const closeModal = () => {
    confirmingUserDeletion.value = false;
    const element = document.getElementsByClassName("modal-open");
    element[0].classList.remove("modal-open");
    const collection = document.getElementsByClassName("modal-backdrop fade show");
    collection[0].remove();
}

const confirmUserDeletion = (id) => {
    confirmingUserDeletion.value = true;
    foodDelete.value = id;
}

const deleteFood = () => {
    Inertia.delete(route('foods.destroy', { 'id': foodDelete.value }), {
        preserveState: false,
        preserveScroll: false,
        onBefore: visit => { },
        onStart: visit => { },
        onProgress: progress => { },
        onSuccess: page => { closeModal(); },
        onError: errors => { },
        onFinish: visit => { },
    })
}


//When next page
const clickCallback = function (pageNum) {
    this.$inertia.visit(route('foods.index', { 'page': pageNum }), {
        method: 'get',
        preserveState: true,
        preserveScroll: true,
        onBefore: visit => { },
        onStart: visit => { },
        onProgress: progress => { },
        onSuccess: page => { },
        onError: errors => { },
        onFinish: visit => { },
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
        <div>
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
                            <td>{{ index + 1 }}</td>
                            <td>
                                <Link :href="(route('foods.show', { 'id': food.id }))">{{ food.name }}</Link>
                            </td>
                            <td>{{ food.count }}</td>
                            <td>{{ food.description }}</td>
                            <td>{{ food.category.name }}</td>
                            <td class="text-right" style="padding-right: 0">
                                <Link :href="(route('foods.edit', { 'id': food.id }))" class="btn btn-primary">Edit</Link>
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
                <span class="mr-auto text-muted">Showing {{ foods.from }} to {{ foods.to }} of {{ foods.total }} results</span>
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
                    <p>Are you sure your want to delete your account?</p>
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