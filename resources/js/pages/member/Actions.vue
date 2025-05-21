<script setup lang="ts">
import { Button, buttonVariants } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Member } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Edit, Trash } from 'lucide-vue-next';

defineProps<{
    member: Member;
}>();

defineEmits<{
    (e: 'delete', member: Member): void;
}>();
</script>

<template>
    <div class="flex items-center justify-end gap-3">
        <Link :href="route('member.edit', member.id)" :class="cn(buttonVariants({ variant: 'outline', size: 'sm' }))"> <Edit /> Edit </Link>
        <Button variant="destructive" @click="$emit('delete', member)" size="sm" v-if="!member.is_membership"> <Trash /> Hapus </Button>
    </div>
</template>

<style scoped></style>
