<script setup lang="ts">
import { cn } from '@/lib/utils';
import { HTMLAttributes } from 'vue';

const props = defineProps<{
    title: string;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <div :class="cn(['mb-5 flex items-center justify-between space-y-2', props.class])">
        <h2 class="text-2xl font-bold tracking-tight">{{ title }}</h2>
        <slot />
    </div>
</template>

<style scoped></style>
