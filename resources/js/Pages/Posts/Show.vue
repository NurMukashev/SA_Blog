<script setup>

    import {Head, router, useForm, Link} from "@inertiajs/vue3";
    import Layout from "@/Pages/Layout.vue";

    const props = defineProps({
        post: Object,
        post_author: String,
        post_category: String,
        comments: Object,
        auth_user: Boolean
    })

    const form = useForm({
        newComment: ''
    })

    function commentStore(){
        router.post('/comments', {
            text: form.newComment
        })
        form.newComment = ''
    }

</script>

<template>

    <Head>
        <title>
            {{ post.title }}
        </title>
    </Head>

    <layout>

        <div class="mb-7 pb-3 border-b-4 border-b-black">
            <h2 class="h2-sa">{{ post.title }}</h2>
            <span v-if="post_category" class="underline">Категория: {{ post_category }},</span> <span>id:{{ post.id }}</span>
            <div class="text-xl">{{ post.text }}</div>
            <span class="italic">Автор: {{ post_author }}</span>
        </div>

        <h3 class="font-bold">Комментарии</h3>
        <div v-for="comment in comments" :key="comment.id" class="mb-2 pb-2 border-b-2 border-b-black">
            <span class="italic">{{ comment.author}}</span>
            <p>{{ comment.text }}</p>
            <span>{{ comment.created_at }}</span>
        </div>


        <form v-if="auth_user" @submit.prevent="commentStore" class="w-1/4 flex flex-col">
            <textarea v-model="form.newComment" class="mb-4"></textarea>
            <button type="submit" class="button-sa">добавить</button>
        </form>
        <div v-else >Для добавления комментариев надо пройти аутентификацию
            <Link :href="route('login')" class="underline">Войти</Link>
        </div>

    </layout>

</template>

<style scoped>

</style>
