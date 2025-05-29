<script lang="ts" setup>
import { findConfig } from '@/lib/utils';
import { Config } from '@/types';
import { Users } from 'lucide-vue-next';

defineProps<{ configs: Config[]; countMember: number; countMembership: number; countAlumni: number }>();
</script>

<template>
    <section id="home" class="pt-16">
        <div class="relative flex h-screen items-center justify-center overflow-hidden bg-gradient-to-r from-amber-800">
            <div class="bg-texture absolute inset-0 opacity-10"></div>
            <div class="absolute inset-0">
                <img
                    class="h-full w-full object-cover opacity-30"
                    :src="`/storage/${findConfig('hero_image', configs)}`"
                    :alt="findConfig('hero_image', configs)"
                    @error="($event: any) => ($event.target.src = 'https://images.unsplash.com/photo-1508873696983-2dfd5898f08b?q=80&amp;w=1200')"
                />
            </div>
            <div class="relative container mx-auto px-4">
                <div class="animate-fade-in mb-16 text-center text-white">
                    <h1 class="mb-6 text-4xl font-bold md:text-6xl">{{ findConfig('hero_title', configs) }}</h1>
                    <p class="pb-8 text-xl opacity-90 md:text-2xl">{{ findConfig('hero_description', configs) }}</p>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-6 pb-20 md:grid-cols-3">
                    <div
                        class="transform rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-md transition-all duration-500 hover:scale-105 hover:bg-white/20"
                    >
                        <div class="mb-4 flex items-center justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20">
                                <Users class="h-8 w-8 text-white" />
                            </div>
                        </div>
                        <h1 class="mb-2 text-4xl font-bold text-white">{{ countMember ?? '0' }}</h1>
                        <span class="mb-1 text-lg font-medium text-white/90">Anggota Aktif</span>
                    </div>
                    <div
                        class="transform rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-md transition-all duration-500 hover:scale-105 hover:bg-white/20"
                    >
                        <div class="mb-4 flex items-center justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20">
                                <Users class="h-8 w-8 text-white" />
                            </div>
                        </div>
                        <h1 class="mb-2 text-4xl font-bold text-white">{{ countMembership ?? '0' }}</h1>
                        <span class="mb-1 text-lg font-medium text-white/90">Pengurus Aktif</span>
                    </div>
                    <div
                        class="transform rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-md transition-all duration-500 hover:scale-105 hover:bg-white/20"
                    >
                        <div class="mb-4 flex items-center justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20">
                                <Users class="h-8 w-8 text-white" />
                            </div>
                        </div>
                        <h1 class="mb-2 text-4xl font-bold text-white">{{ countAlumni ?? '0' }}</h1>
                        <span class="mb-1 text-lg font-medium text-white/90">Alumni</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
