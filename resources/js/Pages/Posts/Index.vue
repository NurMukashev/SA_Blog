<template>
    <Head title="Все посты" />
    <h2>Все посты</h2>

    <Link :href="route('posts.create')">создать</Link>
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
            <tr v-for="post in posts">
                <td>{{ post.id }}</td>
                <td>{{ post.id }}</td>
                <td>{{ post.id }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.text }}</td>
                <td>{{ post.created_at }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";

export default {
    name: "Index",

    components: {
        Head,
        Link
    },

    props:{
        posts: Object,
    }
}
</script>

<style scoped>

</style>
