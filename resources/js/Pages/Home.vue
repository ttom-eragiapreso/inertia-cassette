<script>
import Layout from "@/Shared/Layout.vue";
export default {
    layout: Layout,
};
</script>

<script setup>
import { Head } from "@inertiajs/vue3";
import { onMounted } from "@vue/runtime-core";

const props = defineProps({
    library: Array,
});

onMounted(() => {
    console.log("ciao");
});
</script>

<template>
    <Head title="Your Music Collection" />

    <div v-if="props.library">
        <h1>La tua libreria</h1>
    </div>
    <div v-else>
        <h1>Non hai ancora nessuna cassetta :(</h1>
    </div>
</template>
