<script setup>
import {router, useForm} from "@inertiajs/vue3";

    const form = useForm({
        newComment: ''
    })

    function store(){
        router.post('/comments', {
            text: form.newComment,
        })
    }

</script>

<template>

    <form @submit.prevent="store">
        <textarea v-model="form.newComment"></textarea>
        <button type="submit">добавить</button>
    </form>

</template>

<style scoped>

</style>
