<script setup>
import { ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null)
</script>

<template>
    <input 
    class="form-control"
    :value="modelValue" 
    @input="$emit('update:modelValue',$event.target.value)"
    ref="input"/>
    
</template>