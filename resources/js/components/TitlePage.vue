<script setup lang="ts">
defineProps<{
    title: string;
}>();
</script>

<template>
    <div class="mb-5 flex items-center justify-between space-y-2">
        <h2 class="text-2xl font-bold tracking-tight">{{title}}</h2>
        <slot />
    </div>
</template>

<style scoped>

</style>
