<script setup>
import {Head, Link, useForm, router} from "@inertiajs/vue3";

    const props = defineProps({
        post: Object,
        categories:Object,
        errors: Object
    })

    const form = useForm({
        title: props.post.title,
        text: props.post.text,
        category_id: props.post.category_id
    })

    function submit(){
        router.post(`/posts/${props.post.id}`, {
            _method: 'put',
            title: form.title,
            text: form.text,
            category_id: form.category_id
        })
    }
</script>

<template>
    <Head title="Изменение поста" />

    <h2>Изменение поста</h2>
    <Link :href="route('posts.index')">назад</Link>

    <form @submit.prevent="submit">

        <input v-model="form.title" type="text" placeholder="Title" />
        <div v-if="errors.title">{{ errors.title }}</div>

        <textarea v-model="form.text" id="" cols="30" rows="10"></textarea>
        <div v-if="errors.text">{{ errors.text }}</div>

        <select v-model="form.category_id">
            <option value="">Выберите категорию</option>
            <option v-for="category in categories" :selected="category.id == form.category_id" :value="category.id">{{ category.name }}</option>

        </select>

        <button type="submit" >изменить</button>

    </form>
</template>

<style scoped>

</style>
