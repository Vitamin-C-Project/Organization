<script setup lang="ts">
import {Button} from '@/components/ui/button';
import { Position } from '@/types';
import {Edit, Trash} from 'lucide-vue-next';

defineProps<{
    position: Position;
}>();

defineEmits<{
    (e: "edit", position: Position): void;
    (e: "delete", position: Position): void;
}>();
</script>

<template>
    <div class="flex items-center gap-3 justify-end">
        <Button variant="outline" @click="$emit('edit', position)" size="sm">
            <Edit /> Edit
        </Button>
        <Button variant="destructive" @click="$emit('delete', position)" size="sm">
            <Trash /> Hapus
        </Button>
    </div>
</template>

<style scoped>

</style>
