<script setup>
import {Head, Link, useForm, router} from "@inertiajs/vue3";
import Layout from "@/Pages/Layout.vue";

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

    <layout>
        <h2 class="h2-sa">Изменение поста</h2>
        <Link :href="route('posts.index')" class="hover:underline">назад</Link>

        <form @submit.prevent="submit" class="flex flex-col justify-between">

            <div class="mb-4">
                <input v-model="form.title" type="text" placeholder="Title" class="w-full" />
                <div v-if="errors.title">{{ errors.title }}</div>
            </div>

            <div class="mb-4">
                <textarea v-model="form.text" id="" cols="30" rows="10" class="w-full"></textarea>
                <div v-if="errors.text">{{ errors.text }}</div>
            </div>

            <select v-model="form.category_id" class="mb-4">
                <option value="">Выберите категорию</option>
                <option v-for="category in categories" :selected="category.id == form.category_id" :value="category.id">{{ category.name }}</option>
            </select>

            <button type="submit" class="button-sa">изменить</button>

        </form>
    </layout>
</template>

<style scoped>

</style>
