<script setup lang="ts">
import Folder from '@/components/Folder.vue';
import InputError from '@/components/InputError.vue';
import Pagination from '@/components/Pagination.vue';
import Switch from '@/components/Switch.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Album, MetaPagination } from '@/types';
import { Head } from '@inertiajs/vue3';
import { LoaderCircle, Plus, Send } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import Hook from '.';

const { state, handler } = Hook();

const props = defineProps<{ albums: MetaPagination }>();

const tableData = ref<Album[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.albums.data];
    metaPagination.value = props.albums;
});
</script>

<template>
    <Head title="Galeri" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <TitlePage title="Galeri">
            <div class="flex items-center space-x-2">
                <Button @click="handler.handleShowDialog(true, 'Buat Album Baru')">
                    <Plus />
                    Buat Album
                </Button>
            </div>
        </TitlePage>

        <div v-if="tableData.length < 1" class="mt-20">
            <h1 class="text-center font-normal">Belum ada album</h1>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <Folder
                v-for="album in tableData"
                :key="album.id"
                :album="album"
                @edit="handler.handleEdit"
                @update-status="handler.handleUpdateStatus"
                @delete="handler.handleDelete"
            />
        </div>

        <Pagination :meta-pagination="metaPagination!" v-if="tableData.length > 0" />
    </AppLayout>

    <Dialog :open="state.showDialog.value.show" @update:open="handler.handleShowDialog(false, '')">
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ state.showDialog.value.title }}</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="handler.handleSubmit">
                <div class="my-5 grid gap-6">
                    <div class="grid gap-2">
                        <Label for="title">Judul</Label>
                        <Input
                            id="title"
                            type="text"
                            autofocus
                            :tabindex="1"
                            autocomplete="title"
                            placeholder="misal: Album Angkatan 2020"
                            v-model="state.form.title"
                            :disabled="state.form.processing"
                        />
                        <InputError :message="state.form.errors.title" />
                    </div>
                    <div class="grid gap-2" v-if="state.showDialog.value.type === 1">
                        <Label for="status">Munculkan Halaman Depan</Label>
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
