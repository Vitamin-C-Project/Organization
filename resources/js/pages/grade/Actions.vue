<script setup lang="ts">
import {Button} from '@/components/ui/button';
import { Grade } from '@/types';
import {Edit, Trash} from 'lucide-vue-next';

defineProps<{
    grade: Grade;
}>();

defineEmits<{
    (e: "edit", grade: Grade): void;
    (e: "delete", grade: Grade): void;
}>();
</script>

<template>
    <div class="flex items-center gap-3 justify-end">
        <Button variant="outline" @click="$emit('edit', grade)" size="sm">
            <Edit /> Edit
        </Button>
        <Button variant="destructive" @click="$emit('delete', grade)" size="sm">
            <Trash /> Hapus
        </Button>
    </div>
</template>

<style scoped>

</style>
