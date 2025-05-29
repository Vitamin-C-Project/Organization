<script lang="ts" setup>
import ImageNotFoundPng from '@/assets/image/not-found.png';
import { Gallery } from '@/types';

defineProps<{ galleries: Gallery[] }>();
</script>

<template>
    <section id="gallery" class="bg-white py-20">
        <div class="container mx-auto px-4">
            <h1 class="!mb-12 text-center text-3xl font-bold text-amber-900">Galeri</h1>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="group relative overflow-hidden rounded-lg" v-for="gallery in galleries" :key="gallery.id">
                    <img
                        alt="Mountain Hiking"
                        class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                        :src="`/storage/${gallery.file_path}`"
                        @error="($event: any) => ($event.target.src = ImageNotFoundPng)"
                        loading="lazy"
                    />
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                    >
                        <div
                            class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                        >
                            <h1 class="!mb-2 text-lg font-semibold">{{ gallery.album?.title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
