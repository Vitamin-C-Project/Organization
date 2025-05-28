<script setup lang="ts">
import { Button, buttonVariants } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Article } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Edit, Trash } from 'lucide-vue-next';

defineProps<{
    article: Article;
}>();

defineEmits<{
    (e: 'delete', article: Article): void;
}>();
</script>

<template>
    <div class="flex items-center justify-end gap-3">
        <Link :href="route('article.edit', article.id)" :class="cn(buttonVariants({ variant: 'outline', size: 'sm' }))"><Edit /> Edit</Link>
        <Button variant="destructive" @click="$emit('delete', article)" size="sm"> <Trash /> Hapus </Button>
    </div>
</template>

<style scoped></style>
