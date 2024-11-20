<script setup>
import {defineProps, ref} from 'vue';
import axios from 'axios';

let props = defineProps({
    messages:{
        type: Array,
        required: false,
    }
})
let msg = ref('');
let store = function(){
    axios.post('/messages', {body: msg.value})
        .then(res =>{
            props.messages.unshift(res.data)
        });
}
</script>

<template>
    <div class="w-1/2 mx-auto py-6">
        <div class="mb-4">
           <h3>Messages</h3>
            <div v-if="messages.length > 0">
                <div v-for="message in messages" :key="message.id">
                    {{ message.id }} - {{ message.body }} - {{ message.time }}
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="mb-4">
                <input type="text" v-model="msg" placeholder="your message" class="rounded-lg border-gray-400">
            </div>
            <div class="mb-4">
                <input @click.prevent = store() type="submit" value="Send" class=" rounded-lg block w-48 bg-sky-400 text-white text-center py-2">
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
