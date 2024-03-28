<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import Layout from "@/Pages/Layout.vue";


    const props = defineProps({
        posts: Object,
        filters: Object
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

        <h2 class="font-bold text-lg mx-auto text-center uppercase mt-2 mb-6">Все посты</h2>

        <div class="flex justify-between mb-8 max-w-4xl mx-auto">
            <input v-model="search" type="text" placeholder="поиск">
            <Link :href="route('posts.create')" class="bg-gray-400 text-white px-4 py-1 text-lg leading-loose hover:bg-gray-700">создать</Link>
        </div>

        <section v-for="post in posts.data" class="max-w-4xl mx-auto mb-6 border-b-4 border-b-black">
            <h2 class="font-bold hover:underline"><Link :href="route('posts.show', post.id)">{{ post.title }}</Link></h2>
            <div class="flex justify-between">
                <span class="underline">Категория: {{ post.category }}</span>
                <span class="italic">Автор: {{ post.author }}</span>
            </div>
            <div>{{ post.text }}</div>
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
