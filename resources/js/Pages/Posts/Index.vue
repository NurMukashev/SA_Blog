<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import Layout from "@/Pages/Layout.vue";


    const props = defineProps({
        posts: Object,
        filters: Object,
        current_user: Number
    })

    let search = ref(props.filters.search);


    watch(search, value => {
        router.get('/posts', {search:value}, {
            preserveState: true,
            replace: true
        });
    });
</script>
<template>
    <Head title="Все посты"/>

    <layout>

        <h2 class="h2-sa">Все посты</h2>

        <div class="flex justify-between mb-8 max-w-4xl mx-auto">
            <input v-model="search" type="text" placeholder="поиск">
            <Link :href="route('posts.create')" class="button-sa">создать</Link>
        </div>

        <section v-for="post in posts.data" class="max-w-4xl mx-auto mb-6 border-b-4 border-b-black">
            <h2 class="font-bold hover:underline"><Link :href="route('posts.show', post.id)">{{ post.title }}</Link></h2>
            <div class="flex justify-between">
                <span v-if="post.category" class="underline">Категория: {{ post.category }}</span>, <span>id: {{ post.id }}</span>
                <span class="italic">Автор: {{ post.author }}</span>
            </div>
            <div>{{ post.text }}</div>
            <div v-if="post.user_id === current_user" class="flex justify-end mb-2">
                <Link :href="route('posts.edit', post.id)" class="button-sa bg-green-600 py-0">изменить</Link>
                <Link :href="route('posts.destroy', post.id)" class="button-sa ml-2 bg-red-600 py-0">удалить</Link>
            </div>
        </section>

        <!--<table>   Хотел в начале в виде таблицы
            <thead>
                <tr>
                    <th>id</th>
                    <th>категория</th>
                    <th>автор</th>
                    <th>title</th>
                    <th>text</th>
                    <th>создано</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts.data">
                    <td>{{ post.id }}</td>
                    <td>{{ post.category }}</td>
                    <td>{{ post.author }}
                        <Link :href="route('posts.edit', post.id)">изменить</Link>
                        <Link :href="route('posts.destroy', post.id)">удалить</Link>
                    </td>
                    <td><Link :href="route('posts.show', post.id)">{{ post.title }}</Link></td>
                    <td>{{ post.text }}</td>
                    <td>{{ post.created_at }}</td>
                </tr>
            </tbody>
        </table>-->

    </layout>

</template>

<style scoped>

</style>
