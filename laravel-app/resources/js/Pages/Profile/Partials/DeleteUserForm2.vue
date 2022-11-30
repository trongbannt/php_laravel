<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { nextTick, ref, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import ModalCusVue from '@/Components/ModalCus.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
}


const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    //nextTick(() => passwordInput.value.focus());
}

const deleteAccount = () => {
    confirmingUserDeletion.value = false;

    // form.delete(route('profile.destroy'), {
    //     preserveScroll: true,
    //     onSuccess: () => closeModal(),
    //     onError: () => passwordInput.value.focus(),
    //     onFinish: () => form.reset(),
    // });
}


</script>
<template>
    <section>
        <header>
            <h3>Delete Account 2</h3>
        </header>
        <a class="btn btn-primary " @click="confirmUserDeletion">
            DELETE ACCOUNT
        </a>

        <ModalCusVue :show="confirmingUserDeletion" @close="closeModal">
            <div>
                <span>Are you sure your want to delete your account?</span>
            </div>
                <!-- <div>
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
                <div>
                    <button type="button" class="btn btn-light mr-2" @click="closeModal"
                        data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-danger" @click="deleteAccount">DELETE
                        ACCOUNT</button>
                </div> -->
        </ModalCusVue>
    </section>
</template>