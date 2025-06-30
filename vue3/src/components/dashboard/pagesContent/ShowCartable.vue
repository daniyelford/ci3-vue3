<template>hi{{ props.id }}</template>
<script setup>
    import { defineProps } from 'vue'
    const props = defineProps({
        id: Number
    })
</script>