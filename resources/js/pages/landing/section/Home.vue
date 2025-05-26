<script lang="ts" setup>
import { findConfig } from '@/lib/utils';
import { Config } from '@/types';

defineProps<{ configs: Config[] }>();
</script>

<template>
    <section id="home" class="pt-16">
        <div class="relative flex h-screen items-center justify-center overflow-hidden bg-gradient-to-r from-amber-800">
            <div class="bg-texture absolute inset-0 opacity-10"></div>
            <div class="absolute inset-0">
                <img
                    alt="Hero background"
                    class="h-full w-full object-cover opacity-30"
                    src="https://images.unsplash.com/photo-1508873696983-2dfd5898f08b?q=80&amp;w=1200"
                />
            </div>
            <div class="relative container mx-auto px-4">
                <div class="animate-fade-in mb-16 text-center text-white">
                    <h1 class="mb-6 text-4xl font-bold md:text-6xl">{{ findConfig('hero_title', configs) }}</h1>
                    <p class="pb-8 text-xl opacity-90 md:text-2xl">{{ findConfig('hero_description', configs) }}</p>
                    <button
                        class="transform rounded-full bg-white px-8 py-3 font-semibold text-amber-800 transition-all duration-300 hover:scale-105 hover:bg-amber-50 hover:shadow-lg focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-amber-800 focus:outline-none"
                    >
                        Join Us Today
                    </button>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-6 pb-20 md:grid-cols-3">
                    <div
                        class="transform rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-md transition-all duration-500 hover:scale-105 hover:bg-white/20"
                    >
                        <div class="mb-4 flex items-center justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-users h-8 w-8 text-white"
                                >
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        </div>
                        <h1 class="mb-2 text-4xl font-bold text-white">5000+</h1>
                        <span class="mb-1 text-lg font-medium text-white/90">Active Scouts</span>
                    </div>
                    <div
                        class="transform rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-md transition-all duration-500 hover:scale-105 hover:bg-white/20"
                    >
                        <div class="mb-4 flex items-center justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-tent h-8 w-8 text-white"
                                >
                                    <path d="M3.5 21 14 3"></path>
                                    <path d="M20.5 21 10 3"></path>
                                    <path d="M15.5 21 12 15l-3.5 6"></path>
                                    <path d="M2 21h20"></path>
                                </svg>
                            </div>
                        </div>
                        <h1 class="mb-2 text-4xl font-bold text-white">100+</h1>
                        <span class="mb-1 text-lg font-medium text-white/90">Camping Events</span>
                    </div>
                    <div
                        class="transform rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-md transition-all duration-500 hover:scale-105 hover:bg-white/20"
                    >
                        <div class="mb-4 flex items-center justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/20">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-award h-8 w-8 text-white"
                                >
                                    <path
                                        d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"
                                    ></path>
                                    <circle cx="12" cy="8" r="6"></circle>
                                </svg>
                            </div>
                        </div>
                        <h1 class="mb-2 text-4xl font-bold text-white">50+</h1>
                        <span class="mb-1 text-lg font-medium text-white/90">Achievement Badges</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
