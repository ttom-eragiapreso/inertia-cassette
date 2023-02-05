<template>
    <h1>{{ props.details.year }}</h1>
</template>

<script setup>
let props = defineProps({
    details: Object,
});
</script>
