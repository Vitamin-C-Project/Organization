<script lang="ts" setup>
import { findConfig } from '@/lib/utils';
import { Config } from '@/types';

defineProps<{ configs: Config[] }>();
</script>

<template>
    <section id="about" class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 items-center gap-9 md:grid-cols-2">
                <div class="animate-slide-up">
                    <h2 class="!mb-6 text-3xl font-bold text-amber-900">{{ findConfig('about_title', configs) }}</h2>
                    <p class="!mb-4 text-amber-800">
                        {{ findConfig('about_description', configs) }}
                    </p>
                    <button class="primary-button flex items-center space-x-2">
                        <span>Learn More</span
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-chevron-right h-5 w-5 transform transition-transform group-hover:translate-x-1"
                        >
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </button>
                </div>
                <div class="group relative h-[400px]">
                    <div class="absolute inset-0 rounded-lg bg-amber-900/20 transition-opacity duration-300 group-hover:opacity-0"></div>
                    <img
                        alt="About us"
                        class="h-full w-full rounded-lg object-cover shadow-lg transition-transform duration-300 group-hover:scale-105"
                        :src="`/storage/${findConfig('about_image', configs)}`"
                        @error="$event.target.src = 'https://images.unsplash.com/photo-1464746133101-a2c3f88e0dd9?q=80&amp;w=800'"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
