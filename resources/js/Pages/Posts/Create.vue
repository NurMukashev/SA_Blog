<script setup>
import {Head, Link, router, useForm} from "@inertiajs/vue3";


    const props = defineProps({
        errors: Object,
        categories: Object
    })

    const form = useForm({
        title: '',
        text: '',
        category_id: ''
    })

    function store(){
        router.post('/posts', {
            title: form.title,
            text: form.text,
            category_id: form.category_id
        })
    }

</script>
<template>
    <Head title="Создание поста" />

    <h2>Создание поста</h2>
    <Link :href="route('posts.index')">назад</Link>

    <form @submit.prevent="store">

        <input v-model="form.title" type="text" placeholder="Title" />
        <div v-if="errors.title" class="text-red">{{ errors.title }}</div>

        <textarea v-model="form.text" id="" cols="30" rows="10"></textarea>
        <div v-if="errors.text" class="text-red">{{ errors.text }}</div>

        <select v-model="form.category_id">
            <option value="">Выберите категорию</option>
            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
        </select>

        <button type="submit">создать</button>

    </form>
</template>

<style scoped>

</style>
