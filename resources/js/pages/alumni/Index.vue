<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import InputError from '@/components/InputError.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { Alumni, MetaPagination } from '@/types';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle, Send } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import Hook from '.';
import { columns } from './column';

const { state, handler } = Hook();

const props = defineProps<{ alumni: MetaPagination }>();

const tableData = ref<Alumni[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.alumni.data];
    metaPagination.value = props.alumni;
});
</script>

<template>
    <Head title="Alumni" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <TitlePage title="Alumni" />

        <DataTable
            :columns="
                columns({
                    delete: handler.handleDelete,
                    edit: handler.handleEdit,
                })
            "
            :data="tableData"
        />

        <Pagination :meta-pagination="metaPagination!" />
    </AppLayout>

    <Dialog :open="state.showDialog.value.show" @update:open="handler.handleShowDialog(false, '')">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ state.showDialog.value.title }}</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="handler.handleUpdate">
                <div class="my-5 grid gap-5">
                    <div class="col-span-2 grid gap-2">
                        <Label for="destination_name">Kegiatan Terakhir</Label>
                        <Select :disabled="state.form.processing" @update:model-value="state.form.type = $event">
                            <SelectTrigger>
                                <SelectValue
                                    :placeholder="
                                        state.form.type
                                            ? state.alumniTypes.find((type) => type.key === Number(state.form.type))?.value
                                            : 'Pilih Kegiatan'
                                    "
                                />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="(type, index) in state.alumniTypes" :key="index" :value="type.key" class="cursor-pointer">
                                        {{ type.value }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <InputError :message="state.form.errors.type" />
                    </div>
                    <div class="col-span-2 grid gap-2">
                        <Label for="destination_name">
                            <span v-if="state.form.type == '1'">Nama Perusahaan</span>
                            <span v-else-if="state.form.type == '2'">Nama Perguruan Tinggi</span>
                            <span v-else-if="state.form.type == '3'">Nama Wirausaha</span>
                            <span v-else>Nama Kegiatan</span>
                        </Label>
                        <Input
                            id="destination_name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="destination_name"
                            v-model="state.form.destination_name"
                            :disabled="state.form.processing"
                            :placeholder="`misal: ${state.form.type == '1' ? 'PT. ABC' : state.form.type == '2' ? 'Universitas Wiralodra' : state.form.type == '3' ? 'Ternak Lele' : 'Mencari Kerja'}`"
                        />
                        <InputError :message="state.form.errors.destination_name" />
                    </div>
                    <div class="col-span-2 grid gap-2">
                        <Label for="appointment">
                            <span v-if="state.form.type == '1' || state.form.type == '3'">Jabatan</span>
                            <span v-else-if="state.form.type == '2'">Jurusan</span>
                            <span v-else>Deskripsi</span>
                        </Label>
                        <Input
                            id="appointment"
                            type="text"
                            required
                            :tabindex="2"
                            autocomplete="appointment"
                            v-model="state.form.appointment"
                            :disabled="state.form.processing"
                            :placeholder="`misal: ${state.form.type == '1' || state.form.type === '3' ? 'PT. ABC' : state.form.type === '2' ? 'Universitas Wiralodra' : 'Mencari Kerja'}`"
                        />
                        <InputError :message="state.form.errors.appointment" />
                    </div>
                    <div class="col-span-2 grid gap-2">
                        <Label for="graduation_year">Tahun Lulus</Label>
                        <Input
                            id="graduation_year"
                            type="text"
                            required
                            :tabindex="2"
                            autocomplete="graduation_year"
                            v-model="state.form.graduation_year"
                            :disabled="state.form.processing"
                            placeholder="misal: 2020/2021"
                        />
                        <InputError :message="state.form.errors.graduation_year" />
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
