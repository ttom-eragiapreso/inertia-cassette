<script>
import Layout from '@/Shared/Layout.vue';
export default {
    layout: Layout
}
</script>

<script setup>
import { Head } from '@inertiajs/vue3';
import { onMounted } from '@vue/runtime-core';

onMounted(() =>{
    console.log('ciao')
} )


</script>

<template>

    <Head title="Your Music Collection" />



</template>
