<script setup>
    import {Head} from "@inertiajs/vue3";

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

    <h2>{{ post.title }}</h2>
    <div>{{ post.text }}</div>

    <div> <!--для комментариев-->

    </div>
</template>

<style scoped>

</style>
