<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const currentPasswordInput = ref(null);
const newPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    new_password: '',
    new_password_confirmation:'',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if(form.errors.updatePassword.new_password){
                form.reset('new_password','new_password_confirmation')
                newPasswordInput.value.focus();
            }
            if(form.errors.current_password){
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
}


</script>
<template>
    <section>
        <header>
            <header>
                <h3>Update Password</h3>
                <p>Ensure your account is using a long, random password to stay secure.</p>
            </header>
        </header>

        <form @submit.prevent="updatePassword">
            <div>
                <TextInput 
                    type="password" 
                    v-model="form.current_password"
                    ref="currentPasswordInput"
                    autofocus
                    placeholder="Current Password"
                >
                </TextInput>
                <InputError v-if="form.errors.updatePassword" :message="form.errors.updatePassword.current_password"></InputError>
            </div>
            <div class="mt-3">
                <TextInput
                    type="password"
                    placeholder="New Password"
                    v-model="form.new_password"
                    ref="newPasswordInput"
                ></TextInput>
                <InputError v-if="form.errors.updatePassword" :message="form.errors.updatePassword.new_password"></InputError>
            </div>
            <div class="mt-3">
                <TextInput
                    type="password"
                    placeholder="Confirm Password"
                    v-model="form.new_password_confirmation"
                ></TextInput>
            </div>
            <div class="mt-3">
                <button type="submit" :disabled="form.processing" class="btn btn-secondary">Save</button>
                <span v-if="form.recentlySuccessful" class="text-success align-self-center pl-3" id="status_upate_password">Saved success</span>
            </div>
        </form>


    </section>
</template>