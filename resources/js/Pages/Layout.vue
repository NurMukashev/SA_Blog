<script setup>
import {Link} from "@inertiajs/vue3";

</script>
<template>
    <header>
        <ul>
            <li><Link :href="route('posts.index')">Посты</Link></li>
            <li><Link :href="route('categories.index')">Категории</Link></li>
            <li><Link :href="route('users')">Пользователи</Link></li>
        </ul>
    </header>

    <main>
        <slot/>
    </main>
</template>

<style scoped>

</style>
