<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Config } from '@/types';
import { Edit } from 'lucide-vue-next';

defineProps<{
    config: Config;
}>();

defineEmits<{
    (e: 'edit', config: Config): void;
}>();
</script>

<template>
    <div class="flex items-center justify-end gap-3">
        <Button variant="outline" @click="$emit('edit', config)" size="sm"> <Edit /> Edit </Button>
    </div>
</template>

<style scoped></style>
