<script setup lang="ts">
import {Button} from '@/components/ui/button';
import { AcademicYear } from '@/types';
import {Edit, Trash} from 'lucide-vue-next';

defineProps<{
    year: AcademicYear;
}>();

defineEmits<{
    (e: "edit", year: AcademicYear): void;
    (e: "delete", year: AcademicYear): void;
}>();
</script>

<template>
    <div class="flex items-center gap-3 justify-end">
        <Button variant="outline" @click="$emit('edit', year)" size="sm">
            <Edit /> Edit
        </Button>
        <Button variant="destructive" @click="$emit('delete', year)" size="sm">
            <Trash /> Hapus
        </Button>
    </div>
</template>

<style scoped>

</style>
