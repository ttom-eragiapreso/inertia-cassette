<template>
    <h2 class="text-center text-xl">
        Here you can search music by artist name or by release title!
    </h2>

    <div class="container mx-auto text-center my-3">

      <form @submit.prevent="submit" >
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
            >Search</Link>
            <!-- <button type="submit">Search</button> -->

      </form>

    </div>

    <!-- If there is pagination I show info about the number of results and how many pages -->
    <div v-if="pagination">
      <h2>Results found : {{ pagination.items }} for <span v-if="artist">Artist: {{ artist }}</span><span v-if="release_title">Release Title: {{ release_title }}</span></h2>
      <h3>Page: {{ pagination.page }} of {{ pagination.pages }}</h3>
    </div>

<!-- If there are results, I print them here -->
<div v-if="results">
    <div class="container md:gap-x-4 mx-auto flex flex-wrap justify-around px-5 columns-2 md:columns-4 lg:columns-6">

        <div class="flex flex-col justify-between min-h-72 mb-28 p-3 bg-slate-300 shadow-lg shadow-space-700/80 rounded-xl transition ease-in-out delay-50 duration-300 hover:scale-110 hover:shadow-xl hover:shadow-space-700/90" v-for="record in results" :key="record.id">

            <div class="shadow-md shadow-slate-400 rounded-lg overflow-hidden">
                <img :src="record.cover_image"
                class="shrink-0 w-48 object-cover h-full  max-w-full "
                alt="title">
            </div>


            <div class="w-48 rounded-b-xl h-auto text-center">
                <h5 class="text-black-500 mb-3">{{ getTitle(record) }}</h5>
                <h6 class="text-slate-600 mb-4">{{ getAuthor(record) }}</h6>
            <div class="flex justify-center">
                <a href=""
                class="
                bg-mint-500 p-2 text-bisque-50
                rounded-xl
                hover:bg-mint-700">Aggiungi alla libreria</a>
            </div>

            </div>

        </div>

    </div>
</div>

    <!-- Links for paginator -->

    <paginator v-if="pagination"/>



</template>

<script setup>

let form = reactive({
    release_title: "",
    artist: "",
});

let submit = () =>{
    Inertia.post('/query', form)
}

let getAuthor = (record) => {

    if(record.title.includes('-')){
       let words =  record.title.split('-')
       return words[0].trim();
    }else {
        return record.title;
    }

}

let getTitle = (record) => {

    if(record.title.includes('-')){
       let words = record.title.split('-')
       return words[1].trim();
    }else {
       return record.title;
    }

}


let props = defineProps({
    results: Object,
    pagination: Object,
    artist: String,
    release_title: String
});


</script>

<script>
import {Inertia} from "@inertiajs/inertia";
import Layout from "@/Shared/Layout.vue";
import axios from "axios";
import { reactive } from "@vue/reactivity";
import { Link } from "@inertiajs/vue3";
import Paginator from '@/Components/Paginator.vue';
import { computed } from '@vue/runtime-core';
export default {
    layout: Layout,
};
</script>
