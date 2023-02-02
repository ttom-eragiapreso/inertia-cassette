<template>

    <layout>
        <h2>About time : {{ time }}</h2>

    </layout>
</template>

<script setup>
import Layout from '@/Shared/Layout.vue';
defineProps({
    time: String
})
</script>
