<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { nextTick, ref, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
    const collection = document.getElementsByClassName("modal-backdrop fade show");
    collection[0].remove();
}


const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
}

const deleteAccount = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: ()=> closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
}


</script>
<template>
    <section>
        <header>

            <h3>Delete Account</h3>
            <p>Once your account is deleted, all of its resources and data will be permanently
                deleted. Before deleting your
                account, please download any data or information that you wish to retain</p>
        </header>
        <a class="btn btn-danger " @click="confirmUserDeletion" data-toggle="modal" data-target="#exampleModal">
            DELETE ACCOUNT
        </a>

        <Modal :show=confirmingUserDeletion modalId="exampleModal">
            <template #header>
                <span>Are you sure your want to delete your account?</span>
            </template>
            <template #body>
                <div>
                    <p>Once your account is deleted, all of its resources and data will be
                        permanently deleted.
                        Please enter your password to confirm you would like to permanently delete
                        your account.
                    </p>
                    <div>
                        <TextInput type="password" id="password" ref="passwordInput" placeholder="Password"
                            v-model="form.password">
                        </TextInput>
                        <InputError v-if="form.errors.userDeletion" :message="form.errors.userDeletion.password">
                        </InputError>
                    </div>
                </div>
            </template>
            <template #footer>
                <div>
                    <button type="button" class="btn btn-light mr-2" @click="closeModal"
                        data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-danger"  :disabled="form.processing"
                        @click="deleteAccount">DELETE
                        ACCOUNT</button>
                </div>
            </template>
        </Modal>
    </section>
</template>