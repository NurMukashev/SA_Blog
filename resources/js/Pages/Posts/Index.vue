<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import {ref, watch} from "vue";


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
    <Head title="Все посты" />
    <h2>Все посты</h2>

    <Link :href="route('posts.create')">создать</Link>
    <input v-model="search" type="text" placeholder="поиск">
    <table>
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
    </table>
</template>

<style scoped>

</style>
