<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { buttonVariants } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import Hook from '@/pages/member/index';
import { Member, MetaPagination } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import { columns } from './column';

const { state, handler } = Hook({});

const props = defineProps<{ members: MetaPagination }>();

const tableData = ref<Member[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.members.data];
    metaPagination.value = props.members;
});
</script>

<template>
    <Head title="Anggota Organisasi" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <TitlePage title="Anggota Organisasi">
            <div class="flex items-center space-x-2">
                <Link :href="route('member.create')" :class="cn(buttonVariants({ variant: 'default' }))">
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

<style scoped></style>
