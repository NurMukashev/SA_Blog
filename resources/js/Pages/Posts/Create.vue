<script setup>
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import Layout from "@/Pages/Layout.vue";


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

    <layout>
        <h2 class="h2-sa">Создание поста</h2>
        <Link :href="route('posts.index')" class="hover:underline">назад</Link>

        <form @submit.prevent="store" class="flex flex-col justify-between">

            <div class="mb-4">
                <input v-model="form.title" type="text" placeholder="Title" class="w-full"/>
                <div v-if="errors.title" class="text-red">{{ errors.title }}</div>
            </div>

            <div class="mb-4">
                <textarea v-model="form.text" id="" cols="30" rows="10" class="w-full" ></textarea>
                <div v-if="errors.text" class="text-red">{{ errors.text }}</div>
            </div>

            <select v-model="form.category_id" class="mb-4" >
                <option value="">Выберите категорию</option>
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>

            <button type="submit" class="button-sa">создать</button>

        </form>
    </layout>
</template>

<style scoped>

</style>
