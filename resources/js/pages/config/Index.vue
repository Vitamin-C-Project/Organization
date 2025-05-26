<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import InputError from '@/components/InputError.vue';
import Pagination from '@/components/Pagination.vue';
import TitlePage from '@/components/TitlePage.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { showToast } from '@/lib/utils';
import { Config, MetaPagination, SharedData } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle, Send } from 'lucide-vue-next';
import { ref, watchEffect } from 'vue';
import { columns } from './column';

const props = defineProps<{ configs: MetaPagination }>();
const page = usePage<SharedData>();

const tableData = ref<Config[]>([]);
const metaPagination = ref<MetaPagination>();

const configSelected = ref<Config>();
const showDialog = ref<boolean>(false);
const form = useForm({
    key: '',
    value: '',
    type: '',
});

const handleEdit = (config: Config) => {
    showDialog.value = true;

    configSelected.value = config;

    form.key = config.key;
    form.value = config.value;
    form.type = config.type;
};

const handleSubmit = () => {
    form.post(route('config.update', configSelected.value?.id), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            showDialog.value = false;

            showToast(page?.props?.flash);
        },
    });
};

watchEffect(() => {
    tableData.value = [...props.configs.data];
    metaPagination.value = props.configs;
});
</script>

<template>
    <Head title="Konfigurasi Aplikasi" />

    <AppLayout :breadcrumbs="[]">
        <TitlePage title="Konfigurasi Aplikasi"></TitlePage>

        <DataTable
            :columns="
                columns({
                    edit: handleEdit,
                })
            "
            :data="tableData"
        />

        <Pagination :meta-pagination="metaPagination!" />
    </AppLayout>

    <Dialog
        :open="showDialog"
        @update:open="
            () => {
                showDialog = false;
            }
        "
    >
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Edit Konfigurasi</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="handleSubmit">
                <div class="my-5 grid gap-2">
                    <Label>Konten</Label>
                    <Input
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="content"
                        v-model="form.value"
                        :disabled="form.processing"
                        placeholder="misal: Konten"
                        v-if="form.type == 'text'"
                    />
                    <Input
                        type="file"
                        required
                        autofocus
                        :tabindex="1"
                        :disabled="form.processing"
                        v-if="form.type == 'file'"
                        @input="form.value = $event.target.files[0]"
                    />
                    <InputError :message="form.errors.value" />
                </div>
                <DialogFooter>
                    <Button type="submit" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        <Send v-else class="h-4 w-4" /> Simpan
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
