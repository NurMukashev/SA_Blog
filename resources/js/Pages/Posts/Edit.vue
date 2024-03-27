<script setup>
import {Head, Link, useForm, router} from "@inertiajs/vue3";

    const props = defineProps({
        post: Object,
        errors: Object
    })

    const form = useForm({
        title: props.post.title,
        text: props.post.text
    })

    function submit(){
        router.post(`/posts/${props.post.id}`, {
            _method: 'put',
            title: form.title,
            text: form.text
        })
    }
</script>

<template>
    <Head title="Изменение поста" />

    <h2>Изменение поста</h2>
    <Link :href="route('posts.index')">назад</Link>

    <form @submit.prevent="submit">
        <input v-model="title" type="text" placeholder="Title" />
        <div v-if="errors.title">{{ errors.title }}</div>

        <textarea v-model="text" id="" cols="30" rows="10"></textarea>
        <div v-if="errors.text">{{ errors.text }}</div>

        <button type="submit" >изменить</button>
    </form>
</template>

<style scoped>

</style>
