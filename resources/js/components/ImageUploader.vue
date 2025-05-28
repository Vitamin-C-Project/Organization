<template>
    <div class="space-y-4">
        <!-- Dropzone -->
        <label
            for="file-upload"
            class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 p-6 transition hover:bg-gray-50"
        >
            <svg class="mb-2 h-12 w-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 16l4.586-4.586a2 2 0 012.828 0L15 16m6 0V6a2 2 0 00-2-2H5a2 2 0 00-2 2v10m16 0H3"
                />
            </svg>
            <span class="text-sm text-gray-500"> Klik atau seret gambar ke sini untuk mengunggah </span>
            <input
                id="file-upload"
                type="file"
                class="hidden"
                :multiple="multiple"
                :accept="accept"
                @change="handleFileChange"
                :disabled="isLoading"
            />
        </label>

        <!-- Preview -->
        <div v-if="previewUrls.length" class="grid grid-cols-2 gap-4">
            <div v-for="(src, index) in previewUrls" :key="index" class="group relative">
                <img
                    :src="src"
                    class="h-32 w-full rounded-lg object-cover shadow"
                    alt="Preview"
                    @error="($event: any) => ($event.target.src = FolderPng)"
                />
                <button
                    type="button"
                    @click="removeImage(index)"
                    class="absolute top-1 right-1 cursor-pointer rounded-full bg-white p-1 shadow-md hover:bg-red-100"
                    :disabled="isLoading"
                >
                    <svg class="h-4 w-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import FolderPng from '@/assets/image/folder.png';
import { defineExpose, ref } from 'vue';

interface Props {
    multiple?: boolean;
    isLoading?: boolean;
    accept?: string;
}
const props = withDefaults(defineProps<Props>(), {
    multiple: false,
    isLoading: false,
    accept: 'image/*',
});

const files = ref<File[]>([]);
const previewUrls = ref<string[]>([]);

// Untuk parent ambil file
defineExpose({
    getFiles: () => files.value,
});

// Handle file input
const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const selectedFiles = target.files ? Array.from(target.files) : [];

    if (!props.multiple) {
        files.value = selectedFiles.slice(0, 1);
    } else {
        files.value = [...files.value, ...selectedFiles];
    }

    updatePreview();
};

// Preview image
const updatePreview = () => {
    previewUrls.value = files.value.map((file) => URL.createObjectURL(file));
};

// Hapus file tertentu
const removeImage = (index: number) => {
    files.value.splice(index, 1);
    previewUrls.value.splice(index, 1);
};
</script>
