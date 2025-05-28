<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { buttonVariants } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import { Article, MetaPagination } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import Hook from '.';
import { columns } from './column';

const { state, handler } = Hook({});

const props = defineProps<{ articles: MetaPagination }>();

const tableData = ref<Article[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.articles.data];
    metaPagination.value = props.articles;
});
</script>

<template>
    <Head title="Artikel" />

    <AppLayout :breadcrumbs="state.breadcrumbIndex">
        <TitlePage title="Artikel">
            <div class="flex items-center space-x-2">
                <Link :href="route('article.create')" :class="cn(buttonVariants({ variant: 'default' }))">
                    <Plus />
                    Tambah Baru
                </Link>
            </div>
        </TitlePage>

        <DataTable
            :columns="
                columns({
                    delete: handler.handleDelete,
                    updateStatus: handler.handleUpdateStatus,
                })
            "
            :data="tableData"
        />

        <Pagination :meta-pagination="metaPagination!" />
    </AppLayout>
</template>
