<template>
      <div class="h-16 bg-red-500 flex items-center px-5 text-2xl">

            <Link :href="route('home')" class="mr-4 hover:underline">Home</Link>
            <Link :href="route('search')" class="hover:underline" >Search New Music</Link>
            <div class="ml-auto flex">
                <h2>Welcome back {{ username }}</h2>
                <Link :href="route('logout')" method="post" as="button" class="ml-4 hover:underline">Log Out</Link>
            </div>

    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, reactive } from '@vue/runtime-core';
import { usePage } from '@inertiajs/vue3';


    const username = computed(() => usePage().props.auth.user.name)


</script>
