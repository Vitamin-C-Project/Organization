<script setup lang="ts">

import { columns } from './column';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle, Plus, Send } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import DataTable from '@/components/DataTable.vue';
import Hook  from '.';
import { Grade } from '@/types';
import { ref, watchEffect } from 'vue';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import InputError from '@/components/InputError.vue';
import Switch from '@/components/Switch.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

const {state, handler} = Hook();

const props = defineProps<{grades: Grade[]}>()

const tableData = ref<Grade[]>([])

watchEffect(() => {
    tableData.value = [...props.grades]
})
</script>

<template>
    <Head title="Kelas" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <div class="flex items-center justify-between space-y-2 mb-5">
            <h2 class="text-3xl font-bold tracking-tight">Kelas</h2>
            <div class="flex items-center space-x-2">
                <Button @click="handler.handleShowDialog(true, 'Tambah Kelas Baru')"><Plus /> Tambah Baru</Button>
            </div>
        </div>

        <DataTable :columns="columns({
            edit: handler.handleEdit,
            delete: handler.handleDelete,
        })" :data="tableData" />
    </AppLayout>

    <Dialog :open="state.showDialog.value.show" @update:open="handler.handleShowDialog(false, '')">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ state.showDialog.value.title }}</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="handler.handleSubmit">
                <div class="my-5 grid gap-6">
                    <div class="grid gap-2">
                        <Label for="class">Kelas</Label>
                        <Input
                            id="class"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="class"
                            v-model="state.form.class"
                            :disabled="state.form.processing"
                            placeholder="misal: 10 TPM 1"
                        />
                        <InputError :message="state.form.errors.class" />
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

<style scoped>

</style>
