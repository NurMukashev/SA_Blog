<script setup>
    import {Head} from "@inertiajs/vue3";
    import Layout from "@/Pages/Layout.vue";

    const props = defineProps({
        post:Object
    })


</script>

<template>
    <Head>
        <title>
            {{ post.title }}
        </title>
    </Head>

    <layout>
        <h2>{{ post.title }}</h2>
        <div>{{ post.text }}</div>

        <div> <!--для комментариев-->

        </div>
    </layout>
</template>

<style scoped>

</style>
