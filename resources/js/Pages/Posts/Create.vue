<template>
    <Head title="Создание поста" />

    <h2>Создание поста</h2>
    <Link :href="route('posts.index')">назад</Link>

    <form @submit.prevent="submit">
        <input v-model="title" type="text" placeholder="Title" />
        <div v-if="errors.name">{{ errors.name }}</div>

        <textarea v-model="text" id="" cols="30" rows="10"></textarea>
        <div v-if="errors.text">{{ errors.text }}</div>

        <button type="submit" >создать</button>
    </form>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
export default {
    name: "Create",

    components: {
        Head,
        Link,
    },

    props: {
        errors: Object,
    },

    methods: {
        submit(){
            alert('123');
        }
    },
}
</script>

<style scoped>

</style>
