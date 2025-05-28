<script setup lang="ts">
import ImageUploader from '@/components/ImageUploader.vue';
import InputError from '@/components/InputError.vue';
import TextEditor from '@/components/TextEditor.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Button, buttonVariants } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import { Article } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ChevronLeft, Save } from 'lucide-vue-next';
import Hook from '.';

const props = defineProps<{ article: Article }>();

const { state, handler } = Hook({
    article: props.article,
});
</script>

<template>
    <Head title="Edit Artikel" />

    <AppLayout :breadcrumbs="state.breadcrumbIndex">
        <TitlePage title="Edit Artikel">
            <div class="flex items-center space-x-2">
                <Link :class="cn(buttonVariants({ variant: 'outline', size: 'sm' }))" :href="route('article.index')">
                    <ChevronLeft />
                    Kembali
                </Link>
            </div>
        </TitlePage>

        <form class="grid grid-cols-3 gap-6" @submit.prevent="handler.handleUpdate">
            <div class="col-span-2">
                <div class="grid gap-5">
                    <div class="grid gap-2">
                        <Label for="title">Judul Artikel</Label>
                        <Input
                            id="title"
                            type="text"
                            autofocus
                            autocomplete="title"
                            placeholder="misal: Asep Saepullah"
                            v-model="state.form.title"
                            :disabled="state.form.processing"
                        />
                        <InputError :message="state.form.errors.title" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="content">Konten Artikel</Label>
                        <TextEditor v-model:content="state.form.content" :disabled="state.form.processing" />
                        <InputError :message="state.form.errors.content" />
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="grid gap-5">
                    <div class="grid gap-2">
                        <Label for="image">Thumbnail Artikel</Label>
                        <ImageUploader :ref="state.imageRef" :is-loading="state.form.processing" />
                        <InputError :message="state.form.errors.image" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="preview">Thumbnail Sebelumnya</Label>
                        <img :src="`/storage/${article.image}`" class="h-32 w-32 rounded-md" />
                    </div>
                    <div class="flex justify-end">
                        <Button type="submit" :disabled="state.form.processing"><Save /> Simpan</Button>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
