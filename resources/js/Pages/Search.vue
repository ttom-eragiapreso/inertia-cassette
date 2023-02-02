<template>
    <h2 class="text-center text-xl">
        Here you can search music by artist name or by release title!
    </h2>

    <div class="container mx-auto text-center my-3">
        <input
            v-model="form.artist"
            type="text"
            placeholder="Search by artist name"
            class="rounded mx-auto py-1 px-2"
        />
        <input
            v-model="form.release_title"
            type="text"
            placeholder="Search by release title"
            class="rounded mx-auto py-1 px-2"
        />
        <Link
            :href="route('searchApi')"
            as="button"
            method="post"
            class="p-2 bg-orange-700 rounded-md text-stone-300"
            :disabled="!form.release_title && !form.artist"
            :data="{
                release_title: form.release_title,
                artist: form.artist,
            }"
            >Search</Link
        >
    </div>

    <!-- If there are results, I print them here -->
    <div v-if="results">
        <h1 v-for="result in results" :key="result.id">{{ result.title }}</h1>
    </div>

    <!-- If there is pagination, I print it here -->
    <div v-if="pagination">
        <h1>{{ pagination.items }}</h1>
    </div>


</template>

<script setup>
let form = reactive({
    release_title: "",
    artist: "",
});

defineProps({
    results: Object,
    pagination: Object,
});
</script>

<script>
import Layout from "@/Shared/Layout.vue";
import axios from "axios";
import { reactive } from "@vue/reactivity";
import { Link } from "@inertiajs/vue3";
export default {
    layout: Layout,
    components: { Link },
};
</script>
