<script setup lang="ts">
import { MetaPagination } from '@/types';

defineProps<{
    metaPagination: MetaPagination
}>()

import { ChevronLeft, ChevronRight } from 'lucide-vue-next';
import { buttonVariants } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { cn } from '@/lib/utils';
</script>

<template>
    <div class="space-x-6 lg:space-x-8 flex items-center mt-5">
        <div class="flex-1 text-sm text-muted-foreground flex">
            Menampilkan {{metaPagination?.from}} - {{metaPagination?.to}} dari {{metaPagination?.total}} entri.
        </div>
        <div class="space-x-2 flex items-center">
            <Link
                v-for="(pagination, index) in metaPagination.links"
                :key="index"
                :href="pagination.url!"
                :class="cn('p-0', buttonVariants({variant: pagination.active ? 'default' : 'outline'}), pagination.active || !pagination.url && 'pointer-events-none')"
                v-html="pagination.label" />
<!--            <Link-->
<!--                :href="`?page=${metaPagination.current_page - 1}`"-->
<!--                :class="cn('h-8 w-8 p-0', buttonVariants({variant: 'outline'}), metaPagination.current_page < 2 && 'pointer-events-none')"-->
<!--            >-->
<!--                <span class="sr-only">Go to previous page</span>-->
<!--                <ChevronLeft />-->
<!--            </Link>-->
<!--            <Link-->
<!--                :href="`?page=${metaPagination.current_page + 1}`"-->
<!--                :class="cn('h-8 w-8 p-0', buttonVariants({variant: 'outline'}), metaPagination.current_page >= metaPagination.last_page && 'pointer-events-none')"-->
<!--            >-->
<!--                <span class="sr-only">Go to next page</span>-->
<!--                <ChevronRight />-->
<!--            </Link>-->
        </div>
    </div>
</template>

<style scoped>

</style>
