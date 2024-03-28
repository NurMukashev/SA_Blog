<script setup>

const props = defineProps({
    comments: Object
})

</script>

<template>
    <div v-for="comment in comments" :key="comment.id">
        <p>{{ comment.text }}</p>
    </div>
</template>

<style scoped>

</style>
