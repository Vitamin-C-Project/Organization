<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { LoaderCircle, Plus, Send } from 'lucide-vue-next';

import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';

import Hook from '.';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import Switch from '@/components/Switch.vue';
import { AcademicYear, MetaPagination } from '@/types';
import { ref, watchEffect } from 'vue';
import { columns } from '@/pages/academic_year/column';
import DataTable from '@/components/DataTable.vue';
import Pagination from '@/components/Pagination.vue';

// const props = defineProps<{years: AcademicYear[]}>()
//
// const tableData = ref<AcademicYear[]>([])
//
// watchEffect(() => {
//     tableData.value = [...props.years]
// })

const props = defineProps<{years: MetaPagination}>()

const tableData = ref<AcademicYear[]>([])
const metaPagination = ref<MetaPagination>()

watchEffect(() => {
    tableData.value = [...props.years.data]
    metaPagination.value = props.years
})

const { state, handler } = Hook();
</script>

<template>
    <Head title="Tahun Ajaran" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <div class="flex items-center justify-between space-y-2 mb-5">
            <h2 class="text-3xl font-bold tracking-tight">Tahun Ajaran</h2>
            <div class="flex items-center space-x-2">
                <Button @click="handler.handleShowDialog(true, 'Tambah Tahun Ajaran')"><Plus /> Tambah Baru</Button>
            </div>
        </div>

        <DataTable :columns="columns({
            edit: handler.handleEdit,
            delete: handler.handleDelete,
            updateStatus: handler.handleUpdateStatus,
        })" :data="tableData" />

        <Pagination :meta-pagination="metaPagination!" />
    </AppLayout>

    <Dialog :open="state.showDialog.value.show" @update:open="handler.handleShowDialog(false, '')">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ state.showDialog.value.title }}</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="handler.handleSubmit">
                <div class="mt-5 grid gap-6">
                    <div class="grid gap-2">
                        <Label for="year">Tahun</Label>
                        <Input
                            id="year"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="year"
                            v-model="state.form.title"
                            :disabled="state.form.processing"
                            placeholder="misal: Tahun Ajaran 2020/2021"
                        />
                        <InputError :message="state.form.errors.title" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="passcode">Passcode</Label>
                        <Input
                            id="passcode"
                            type="text"
                            required
                            :tabindex="2"
                            autocomplete="passcode"
                            v-model="state.form.passcode"
                            placeholder="misal: P@ssC0d3"
                            :disabled="state.form.processing"
                        />
                        <InputError :message="state.form.errors.passcode" />
                    </div>

                    <div class="grid gap-2">
                        <label class="pr-2 text-sm leading-none text-stone-700 select-none dark:text-white" for="status"> Status </label>
                        <Switch v-model="state.form.status" id="status" />
                    </div>
                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="state.form.processing">
                        <LoaderCircle v-if="state.form.processing" class="h-4 w-4 animate-spin" />
                        <Send v-else class="h-4 w-4" /> Simpan
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>

<style scoped></style>
