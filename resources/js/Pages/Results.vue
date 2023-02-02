<template>

    <div>
        <h1 v-for="result in results" :key="result.id">{{ result.title }}</h1>
    </div>


</template>


<script setup>

defineProps({
    pagination: Object,
    results: Object
})

</script>

<script>
import Layout from '@/Shared/Layout.vue';
export default {
    layout: Layout
}
</script>
