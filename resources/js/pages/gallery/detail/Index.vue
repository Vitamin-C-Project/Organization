<script setup lang="ts">
import ImageUploader from '@/components/ImageUploader.vue';
import InputError from '@/components/InputError.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Button, buttonVariants } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import { Album, Gallery, MetaPagination } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ChevronLeft, Download, LoaderCircle, Plus, Send, Trash } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import Hook from '.';

const props = defineProps<{ album: Album; galleries: MetaPagination }>();

const { state, handler } = Hook({
    album: props.album,
});

const tableData = ref<Gallery[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.galleries.data];
    metaPagination.value = props.galleries;
});
</script>

<template>
    <Head :title="`Galeri ${album.title}`" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <TitlePage :title="`Galeri ${album.title}`" class="flex-col items-start md:flex-row md:items-center">
            <div class="flex items-center space-x-2">
                <Link :href="route('gallery.index')" :class="cn(buttonVariants({ variant: 'outline', size: 'sm' }))"
                    ><ChevronLeft /> <span class="hidden md:inline">Kembali</span></Link
                >
                <Button @click="handler.handleShowDialog(true, 'Tambah File Baru')">
                    <Plus />
                    <span class="hidden md:inline">Tambah File Baru</span>
                </Button>
            </div>
        </TitlePage>

        <div v-if="tableData.length < 1" class="mt-20">
            <h1 class="text-center font-normal">Belum ada file</h1>
        </div>

        <div class="grid gap-4">
            <div v-for="gallery in tableData" :key="gallery.file_extension" class="grid gap-4">
                <h2 class="text-lg font-bold uppercase">{{ gallery.file_extension }}</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <Card
                        v-for="file in gallery.files?.split('|')"
                        :key="handler.convertFile(file)[0]"
                        class="group relative py-0 duration-700 ease-in-out hover:scale-105 hover:transform"
                    >
                        <div class="absolute z-50 hidden h-full w-full rounded-xl bg-black/70 p-2 text-white group-hover:block">
                            <div class="relative h-full w-full">
                                <div class="absolute top-0 right-0 flex items-center gap-3">
                                    <!-- <Button size="sm" variant="ghost" @click="handler.handleDownload(handler.convertFile(file)[4])">
                                        <Download />
                                    </Button> -->
                                    <a
                                        :class="cn(buttonVariants({ variant: 'ghost', size: 'sm' }))"
                                        :href="`/storage/${handler.convertFile(file)[3]}`"
                                        size="sm"
                                        variant="ghost"
                                        download
                                    >
                                        <Download />
                                    </a>
                                    <Button
                                        size="sm"
                                        variant="ghost"
                                        class="hover:bg-destructive text-destructive hover:text-white"
                                        @click="handler.handleDelete(handler.convertFile(file)[4])"
                                    >
                                        <Trash />
                                    </Button>
                                </div>

                                <h1
                                    class="absolute bottom-0 cursor-pointer font-bold"
                                    @click="
                                        () => {
                                            handler.handleShowDialog(true, handler.convertFile(file)[0], 2);
                                            state.fileSelected = handler.renderFile(
                                                gallery.file_extension,
                                                `/storage/${handler.convertFile(file)[3]}`,
                                            );
                                        }
                                    "
                                >
                                    {{ handler.convertFile(file)[0] }} <br />
                                    <span class="text-xs font-normal">({{ handler.convertFile(file)[1] }} bytes)</span>
                                </h1>
                            </div>
                        </div>
                        <img
                            :src="handler.renderImage(gallery.file_extension, `/storage/${handler.convertFile(file)[3]}`)"
                            class="relative z-10 h-60 rounded-xl"
                            loading="lazy"
                        />
                    </Card>
                </div>
            </div>
        </div>

        <Pagination :meta-pagination="metaPagination!" v-if="tableData.length > 0" />
    </AppLayout>

    <Dialog :open="state.showDialog.value.show" @update:open="handler.handleShowDialog(false, '')">
        <DialogContent :class="cn(state.showDialog.value.type == 2 && 'sm:max-w-7xl')">
            <DialogHeader>
                <DialogTitle>{{ state.showDialog.value.title }}</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="handler.handleSubmit" v-if="state.showDialog.value.type == 1">
                <div class="my-5 grid gap-6">
                    <div class="grid gap-2">
                        <Label for="file">Unggah File <span class="text-xs text-red-400">(max 4 file)</span></Label>
                        <ImageUploader
                            :ref="state.filesRef"
                            :is-loading="state.form.processing"
                            multiple
                            accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp4,.mkv,.mp3"
                        />
                        <InputError :message="state.form.errors.files" />
                    </div>
                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="state.form.processing">
                        <LoaderCircle v-if="state.form.processing" class="h-4 w-4 animate-spin" />
                        <Send v-else class="h-4 w-4" /> Simpan
                    </Button>
                </DialogFooter>
            </form>
            <div>
                <iframe
                    :src="state.fileSelected"
                    v-if="state.showDialog.value.type == 2"
                    frameborder="0"
                    width="100%"
                    height="600"
                    class="rounded-xl"
                ></iframe>
            </div>
        </DialogContent>
    </Dialog>
</template>
