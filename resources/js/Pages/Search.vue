<template>
    <h2 class="text-center text-xl">
        Here you can search music by artist name or by release title!
    </h2>

    <div class="container mx-auto text-center my-3">
        <form @submit.prevent="submit">
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
                class="p-2 bg-orange-700 rounded-md text-stone-300"
                :disabled="!form.release_title && !form.artist"
                :data="{
                    release_title: form.release_title,
                    artist: form.artist,
                }"
                >Search</Link
            >
        </form>
    </div>

    <!-- If there is pagination I show info about the number of results and how many pages -->
    <div v-if="switchPagination">
        <h2>
            Results found : {{ switchPagination.items }} for
            <span v-if="artist">Artist: {{ artist }}</span>
            <span v-if="release_title">Release Title: {{ release_title }}</span>
        </h2>
        <h3>
            Page: {{ switchPagination.page }} of {{ switchPagination.pages }}
        </h3>
    </div>

    <!-- If there are results, I print them here -->
    <div v-if="store.results" class="position-relative">
        <div
            class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6"
        >
            <Modal
                v-if="props.show_modal"
                class="position-absolute top-0 left-0 z-10"
                :details="props.response"
            />
            <Album
                v-for="record in switchResults"
                :key="record.id"
                :record="record"
            />
        </div>
    </div>

    <!-- I load the paginator component, only if a pagination comes from the search -->
    <Paginator v-if="switchPagination" :pagination="switchPagination" />
</template>

<script setup>
let form = reactive({
    release_title: "",
    artist: "",
});

let submit = () => {
    Inertia.post("/query", form);
};

const switchResults = computed(() => {
    let collection = props.results
        ? props.results
        : store.results
        ? store.results
        : false;
    return collection;
});

const switchPagination = computed(() => {
    let pages = props.pagination
        ? props.pagination
        : store.pagination
        ? store.pagination
        : false;
    return pages;
});

let props = defineProps({
    results: Object,
    pagination: Object,
    artist: String,
    release_title: String,
    show_modal: Boolean,
    response: Object,
});

onMounted(() => {
    if (props.results) {
        store.results = props.results;
    }
    if (props.pagination) {
        store.pagination = props.pagination;
    }
});

// let showModal = ref(false);
</script>

<script>
import { Inertia } from "@inertiajs/inertia";
import Album from "@/Components/Album.vue";
import Layout from "@/Shared/Layout.vue";
import Modal from "@/Components/Modal.vue";
import axios from "axios";
import { reactive, ref } from "@vue/reactivity";
import { Link } from "@inertiajs/vue3";
import Paginator from "@/Components/Paginator.vue";
import { computed, onMounted } from "@vue/runtime-core";
import { store } from "../data/store";
export default {
    layout: Layout,
};
</script>
