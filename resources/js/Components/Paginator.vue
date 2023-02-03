<template>
    <div v-if="pagination.urls.first"></div>
    <div v-if="pagination.urls.last"></div>
    <div v-if="pagination.urls.prev"></div>
    <div v-if="pagination.urls.next"></div>
</template>

<script setup>



    defineProps({
        pagination: Object
    })

    let submit = () =>{
        Inertia.post('/pagination', url)
    }

</script>
