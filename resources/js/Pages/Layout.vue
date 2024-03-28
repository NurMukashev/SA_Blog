<script setup>
import {Link} from "@inertiajs/vue3";

</script>
<template>
    <header class="bg-gray-300 mb-8 shadow-sm">
        <ul class="flex justify-around py-3 px-1 text-lg">
            <li><Link :href="route('posts.index')" class="hover:underline" :class="{'font-bold':$page.component === 'Posts/Index'}">Посты</Link></li>
            <li><Link :href="route('categories.index')" class="hover:underline" :class="{'font-bold':$page.component === 'Categories/Index'}">Категории</Link></li>
            <li><Link :href="route('users')" class="hover:underline" :class="{'font-bold': $page.url === route('users')}">Пользователи</Link></li>
        </ul>
    </header>

    <main class="max-w-7xl mx-auto bg-green-200 p-2 shadow-md">
        <slot/>
    </main>
</template>

<style scoped>

</style>
