<script setup>
import MainLayout from '@/Layouts/Layout.vue';
import Modal from '@/Components/Modal.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Paginate from "vuejs-paginate-next";
import axios from "axios";
import {ref} from 'vue';

defineProps({
    foods: [],
});

const confirmingUserDeletion = ref(false);

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
    const collection = document.getElementsByClassName("modal-backdrop fade show");
    collection[0].remove();
}

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
}

const deleteAccount = () => {+
    closeModal();
    // form.delete(route('foods.destroy',{'id': food.id }), {
    //     preserveScroll: true,
    //     onSuccess: ()=> closeModal(),
    //     onError: () => passwordInput.value.focus(),
    //     onFinish: () => form.reset(),
    // });
}


const clickCallback = function (pageNum) {
      const url = `http://127.0.0.1:8666/foods?page=2`;

      axios.get(url).then(result => {
        //console.log(result.data);
        this.foods = result.data;
    })
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
                                <!-- <a href="/foods/{{ food.id }}" class="text-decoration-none">{{ food.name }}-{{ food.id }}</a> -->
                                <Link :href="(route('foods.show',{'id': food.id }))"  >{{ food.name }}</Link>
                            </td>
                            <td>{{ food.count }}</td>
                            <td>{{ food.description }}</td>
                            <td>{{ food.category.name }}</td>
                            <td class="text-right" style="padding-right: 0">
                                <Link :href="(route('foods.edit',{'id': food.id }))"  class="btn btn-primary">Edit</Link>
                            </td>
                            <td class="text-left">
                                <a class="btn btn-danger delete_food " @click="confirmUserDeletion"  data-idFood="{{ food.id }}"
                                    data-toggle="modal" data-target="#exampleModal">
                                    Delete
                                </a>
                                <!-- <Link :href="(route('foods.destroy',{'id': food.id }))"  class="btn btn-danger">Delete</Link> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <paginate 
                    :v-model="foods.current_page"
                    :page-count="foods.to"
                    :container-class="'pagination justify-content-end'" 
                    :prev-text="prev" 
                    :next-text="next"
                    :click-handler="clickCallback"
                    :page-class="'page-item'"
                    :page-link-class="'page-link'"
                    :prev-class="'prev-item'"
                    :prev-link-class="'page-link prev-link-item'"
                    :next-class="'next-item'"
                    :next-link-class="'page-link next-link-item'"
                    :break-view-class="'break-view'"
                    :break-view-link-class="'break-view-link'"
                    :first-last-button="false"
                    >
                </paginate>
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
                    <button type="button" class="btn btn-light mr-2" @click="closeModal" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-danger"  :disabled="form.processing" @click="deleteAccount">DELETE</button>
                </div>
            </template>
        </Modal>
    </MainLayout>
</template>