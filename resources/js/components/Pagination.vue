<script setup lang="ts">
import { MetaPagination } from '@/types';

defineProps<{
    metaPagination: MetaPagination;
}>();

import { buttonVariants } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="my-5 flex flex-col items-center gap-5 md:flex-row">
        <div class="text-muted-foreground flex flex-1 text-sm">
            Menampilkan {{ metaPagination?.from }} - {{ metaPagination?.to }} dari {{ metaPagination?.total }} entri.
        </div>
        <div class="flex items-center space-x-2">
            <Link
                v-for="(pagination, index) in metaPagination.links"
                :key="index"
                :href="pagination.url!"
                :class="
                    cn(
                        'p-0',
                        buttonVariants({ variant: pagination.active ? 'default' : 'outline' }),
                        pagination.active || (!pagination.url && 'pointer-events-none'),
                    )
                "
                v-html="pagination.label"
            />
        </div>
    </div>
</template>

<style scoped></style>
