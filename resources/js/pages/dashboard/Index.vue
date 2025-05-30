<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { showToast } from '@/lib/utils';
import { Contact, MetaPagination, SharedData, type BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { Users } from 'lucide-vue-next';
import Swal from 'sweetalert2';
import { ref, watchEffect } from 'vue';
import { columns } from './column';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dasbor',
        href: route('dashboard'),
    },
];

const page = usePage<SharedData>();

const props = defineProps<{ countMember: number; countMembership: number; countAlumni: number; contacts: MetaPagination }>();

const tableData = ref<Contact[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.contacts.data];
    metaPagination.value = props.contacts;
});

const updateStatus = (contact: Contact) => {
    router.put(
        route('contact.update.status', contact.id),
        {},
        {
            preserveScroll: true,
            onSuccess: () => {
                showToast(page?.props?.flash);
            },
        },
    );
};

const deleteContact = (contact: Contact) => {
    Swal.fire({
        icon: 'question',
        title: 'Apakah kamu yakin?',
        text: "Jika iya, masukan 'delete' untuk konfirmasi",
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off',
            required: 'required',
        },
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: 'hsl(0 84% 60%)',
        confirmButtonText: 'Hapus',
        showLoaderOnConfirm: true,
        preConfirm: async (login: string) => {
            if (login.toLowerCase() == 'delete') {
                return true;
            } else {
                Swal.showValidationMessage('Konfirmasi Salah!');
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('contact.destroy', { id: contact.id }), {
                onFinish: () => {
                    showToast(page?.props?.flash);
                },
            });
        }
    });
};
</script>

<template>
    <Head title="Dasbor" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <TitlePage title="Dasbor" />
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            <Card class="relative overflow-hidden border-l-4 border-l-amber-300 shadow-none">
                <CardHeader>
                    <CardTitle>Anggota Organisasi</CardTitle>
                </CardHeader>
                <CardContent>
                    <h1 class="text-2xl font-bold md:text-4xl">{{ countMember ?? '0' }}</h1>
                    <Users class="absolute right-5 -bottom-2 h-20 w-20" />
                </CardContent>
            </Card>
            <Card class="relative overflow-hidden border-l-4 border-l-blue-300 shadow-none">
                <CardHeader>
                    <CardTitle>Anggota Dewan</CardTitle>
                </CardHeader>
                <CardContent>
                    <h1 class="text-2xl font-bold md:text-4xl">{{ countMembership ?? '0' }}</h1>
                    <Users class="absolute right-5 -bottom-2 h-20 w-20" />
                </CardContent>
            </Card>
            <Card class="relative overflow-hidden border-l-4 border-l-emerald-300 shadow-none">
                <CardHeader>
                    <CardTitle>Alumni</CardTitle>
                </CardHeader>
                <CardContent>
                    <h1 class="text-2xl font-bold md:text-4xl">{{ countAlumni ?? '0' }}</h1>
                    <Users class="absolute right-5 -bottom-2 h-20 w-20" />
                </CardContent>
            </Card>

            <div class="col-span-3 space-y-3">
                <h1 class="text-2xl font-bold">Pesan Masuk</h1>
                <DataTable
                    :columns="
                        columns({
                            delete: deleteContact,
                            edit: updateStatus,
                        })
                    "
                    :data="tableData"
                />
                <Pagination :meta-pagination="metaPagination!" v-if="tableData.length > 0" />
            </div>
        </div>
    </AppLayout>
</template>
