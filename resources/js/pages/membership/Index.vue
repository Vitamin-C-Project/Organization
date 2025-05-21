<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { AcademicYear, Member, MetaPagination, Position } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ArrowLeftRight, LoaderCircle, Plus, Send } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import Hook from '.';
import { columns } from './column';

const { state, handler } = Hook({});

const props = defineProps<{ memberships: MetaPagination; members?: Member[]; positions?: Position[]; years?: AcademicYear[] }>();

const tableData = ref<Member[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.memberships.data];
    metaPagination.value = props.memberships;
});
</script>

<template>
    <Head title="Anggota Dewan" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <TitlePage title="Anggota Dewan">
            <div class="flex flex-col items-end gap-3 md:flex-row md:items-center">
                <Button variant="outline" v-if="tableData.length > 0">
                    <ArrowLeftRight />
                    Jadikan Semua Alumni
                </Button>
                <Button @click="handler.handleShowDialog(true, 'Tambah Anggota Baru')">
                    <Plus />
                    Tambah Baru
                </Button>
            </div>
        </TitlePage>

        <DataTable
            :columns="
                columns({
                    edit: handler.handleEdit,
                    delete: handler.handleDelete,
                    transfer: handler.handleTransfer,
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
            <form @submit.prevent="handler.handleSubmit">
                <div class="my-5 grid gap-5">
                    <div class="col-span-2 grid gap-2" v-if="state.showDialog.value.type === 1">
                        <Label for="year">Anggota Organisasi</Label>
                        <Select :disabled="state.form.processing" @update:model-value="state.form.member = $event">
                            <SelectTrigger>
                                <SelectValue :placeholder="'Pilih Anggota'" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="(member, index) in members" :key="index" :value="member.id" class="cursor-pointer">
                                        {{ member.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <InputError :message="state.form.errors.member" />
                    </div>
                    <div class="col-span-2 grid gap-2">
                        <Label for="year">Jabatan Organisasi</Label>
                        <Select :disabled="state.form.processing" @update:model-value="state.form.position = $event">
                            <SelectTrigger>
                                <SelectValue
                                    :placeholder="state.showDialog.value.type === 2 ? state.memberSelected.value?.position?.title : 'Pilih Jabatan'"
                                />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="(position, index) in positions" :key="index" :value="position.id" class="cursor-pointer">
                                        {{ position.title }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <InputError :message="state.form.errors.member" />
                    </div>
                    <div class="col-span-2 grid gap-2">
                        <Label for="year">Tahun Ajaran</Label>
                        <Select :disabled="state.form.processing" @update:model-value="state.form.year = $event">
                            <SelectTrigger>
                                <SelectValue
                                    :placeholder="state.showDialog.value.type === 2 ? state.memberSelected.value?.year?.title : 'Pilih Tahun Ajaran'"
                                />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem v-for="(year, index) in years" :key="index" :value="year.id" class="cursor-pointer">
                                        {{ year.title }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <InputError :message="state.form.errors.year" />
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
