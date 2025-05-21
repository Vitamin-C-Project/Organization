<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Alumni } from '@/types';
import { Edit, Trash } from 'lucide-vue-next';

defineProps<{
    alumni: Alumni;
}>();

defineEmits<{
    (e: 'edit', alumni: Alumni): void;
    (e: 'delete', alumni: Alumni): void;
}>();
</script>

<template>
    <div class="flex items-center justify-end gap-3">
        <Button variant="outline" size="sm" @click="$emit('edit', alumni)"> <Edit /> Edit </Button>
        <Button variant="destructive" @click="$emit('delete', alumni)" size="sm"> <Trash /> Hapus </Button>
    </div>
</template>

<style scoped></style>
