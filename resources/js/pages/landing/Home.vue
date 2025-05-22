<script setup lang="ts">
import Layout from '@/layouts/landing/Layout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Selamat Datang" />
    <Layout>
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
                        <h1 class="mb-6 text-4xl font-bold md:text-6xl">Be Prepared. Be a Scout.</h1>
                        <p class="pb-8 text-xl opacity-90 md:text-2xl">Building character through adventure and service</p>
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
        <section id="about" class="bg-white py-20">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 items-center gap-9 md:grid-cols-2">
                    <div class="animate-slide-up">
                        <h2 class="!mb-6 text-3xl font-bold text-amber-900">About Our Scout Organization</h2>
                        <p class="!mb-4 text-amber-800">
                            We are dedicated to developing young people into responsible citizens through outdoor activities, leadership training, and
                            community service. Our program builds character, teaches practical skills, and instills values that last a lifetime.
                        </p>
                        <p class="!mb-6 text-amber-800">
                            Through camping, hiking, and various outdoor adventures, we help young people develop confidence, leadership skills, and a
                            deep appreciation for nature and conservation.
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
                            src="https://images.unsplash.com/photo-1464746133101-a2c3f88e0dd9?q=80&amp;w=800"
                        />
                    </div>
                </div>
            </div>
        </section>
        <section id="news" class="bg-amber-50/50 py-20">
            <div class="container mx-auto px-4">
                <h2 class="!mb-12 text-center text-3xl font-bold text-white">Latest News</h2>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="news-card">
                        <div class="relative overflow-hidden">
                            <img
                                alt="National Jamboree 2024"
                                class="h-48 w-full object-cover transition-transform duration-300 hover:scale-110"
                                src="https://images.unsplash.com/photo-1599045118108-bf9954418b76?q=80&amp;w=800"
                            />
                        </div>
                        <div class="p-6">
                            <span class="!mb-2 text-sm text-amber-700">March 15, 2024</span>
                            <h3 class="!mb-2 text-xl font-semibold text-amber-900">National Jamboree 2024</h3>
                            <p class="!mb-4 text-sm text-amber-700">Join thousands of scouts for our biggest event of the year</p>
                            <button class="group flex items-center space-x-2 text-amber-800 hover:text-amber-600">
                                <span class="rt-Text">Read More</span
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
                                    class="lucide lucide-chevron-right h-4 w-4 transform transition-transform group-hover:translate-x-1"
                                >
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="news-card">
                        <div class="relative overflow-hidden">
                            <img
                                alt="Environmental Conservation Project"
                                class="h-48 w-full object-cover transition-transform duration-300 hover:scale-110"
                                src="https://images.unsplash.com/photo-1492724724894-7464c27d0ceb?q=80&amp;w=800"
                            />
                        </div>
                        <div class="p-6">
                            <span class="!mb-2 text-sm text-amber-700">March 10, 2024</span>
                            <h3 class="!mb-2 text-xl font-semibold text-amber-900">Environmental Conservation Project</h3>
                            <p class="!mb-4 text-sm text-amber-700">Making a difference in our local ecosystems</p>
                            <button class="group flex items-center space-x-2 text-amber-800 hover:text-amber-600">
                                <span class="rt-Text">Read More</span
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
                                    class="lucide lucide-chevron-right h-4 w-4 transform transition-transform group-hover:translate-x-1"
                                >
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="news-card">
                        <div class="relative overflow-hidden">
                            <img
                                alt="Community Service Award"
                                class="h-48 w-full object-cover transition-transform duration-300 hover:scale-110"
                                src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&amp;w=800"
                            />
                        </div>
                        <div class="p-6">
                            <span class="!mb-2 text-sm text-amber-700">March 5, 2024</span>
                            <h3 class="!mb-2 text-xl font-semibold text-amber-900">Community Service Award</h3>
                            <p class="!mb-4 text-sm text-amber-700">Recognizing outstanding contributions to society</p>
                            <button class="group flex items-center space-x-2 text-amber-800 hover:text-amber-600">
                                <span class="rt-Text">Read More</span
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
                                    class="lucide lucide-chevron-right h-4 w-4 transform transition-transform group-hover:translate-x-1"
                                >
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="gallery" class="bg-white py-20">
            <div class="container mx-auto px-4">
                <h1 class="!mb-12 text-center text-3xl font-bold text-amber-900">Our Adventures</h1>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="group relative overflow-hidden rounded-lg">
                        <img
                            alt="Mountain Hiking"
                            class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?q=80&amp;w=800"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                        >
                            <div
                                class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                            >
                                <h1 class="!mb-2 text-lg font-semibold">Mountain Hiking</h1>
                                <button
                                    class="inline-flex items-center space-x-2 rounded-full border-2 border-white px-6 py-2 text-white transition-colors hover:bg-white hover:text-amber-900"
                                >
                                    <span class="rt-Text">View Gallery</span
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
                                        class="lucide lucide-chevron-right h-4 w-4"
                                    >
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg">
                        <img
                            alt="Camp Setup"
                            class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="https://images.unsplash.com/photo-1519098901909-b1553a1190af?q=80&amp;w=800"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                        >
                            <div
                                class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                            >
                                <h1 class="!mb-2 text-lg font-semibold">Camp Setup</h1>
                                <button
                                    class="inline-flex items-center space-x-2 rounded-full border-2 border-white px-6 py-2 text-white transition-colors hover:bg-white hover:text-amber-900"
                                >
                                    <span class="rt-Text">View Gallery</span
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
                                        class="lucide lucide-chevron-right h-4 w-4"
                                    >
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg">
                        <img
                            alt="Night Camping"
                            class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&amp;w=800"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                        >
                            <div
                                class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                            >
                                <h1 class="!mb-2 text-lg font-semibold">Night Camping</h1>
                                <button
                                    class="inline-flex items-center space-x-2 rounded-full border-2 border-white px-6 py-2 text-white transition-colors hover:bg-white hover:text-amber-900"
                                >
                                    <span class="rt-Text">View Gallery</span
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
                                        class="lucide lucide-chevron-right h-4 w-4"
                                    >
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg">
                        <img
                            alt="Team Building"
                            class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="https://images.unsplash.com/photo-1501703979959-797917eb21c8?q=80&amp;w=800"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                        >
                            <div
                                class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                            >
                                <h1 class="!mb-2 text-lg font-semibold">Team Building</h1>
                                <button
                                    class="inline-flex items-center space-x-2 rounded-full border-2 border-white px-6 py-2 text-white transition-colors hover:bg-white hover:text-amber-900"
                                >
                                    <span class="rt-Text">View Gallery</span
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
                                        class="lucide lucide-chevron-right h-4 w-4"
                                    >
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg">
                        <img
                            alt="Nature Exploration"
                            class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="https://images.unsplash.com/photo-1455577380025-4321f1e1dca7?q=80&amp;w=800"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                        >
                            <div
                                class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                            >
                                <h1 class="!mb-2 text-lg font-semibold">Nature Exploration</h1>
                                <button
                                    class="inline-flex items-center space-x-2 rounded-full border-2 border-white px-6 py-2 text-white transition-colors hover:bg-white hover:text-amber-900"
                                >
                                    <span class="rt-Text">View Gallery</span
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
                                        class="lucide lucide-chevron-right h-4 w-4"
                                    >
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg">
                        <img
                            alt="Adventure Time"
                            class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&amp;w=800"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-amber-900/80 to-transparent opacity-0 transition-all duration-300 group-hover:opacity-100"
                        >
                            <div
                                class="absolute right-0 bottom-0 left-0 translate-y-6 transform p-6 text-white transition-transform duration-300 group-hover:translate-y-0"
                            >
                                <h1 class="!mb-2 text-lg font-semibold">Adventure Time</h1>
                                <button
                                    class="inline-flex items-center space-x-2 rounded-full border-2 border-white px-6 py-2 text-white transition-colors hover:bg-white hover:text-amber-900"
                                >
                                    <span class="rt-Text">View Gallery</span
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
                                        class="lucide lucide-chevron-right h-4 w-4"
                                    >
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="relative bg-amber-50/50 py-20">
            <div class="bg-texture absolute inset-0 opacity-5"></div>
            <div class="relative container mx-auto px-4">
                <h1 class="!mb-12 text-center text-3xl font-bold text-white">Contact Us</h1>
                <div class="grid grid-cols-1 gap-9 md:grid-cols-2">
                    <div class="rounded-lg bg-white/80 p-8 shadow-lg backdrop-blur-sm">
                        <div class="mb-8">
                            <h1 class="!mb-4 text-xl font-semibold text-amber-900">Get in Touch</h1>
                            <div class="space-y-4">
                                <div class="rt-Flex rt-r-ai-center group">
                                    <div
                                        class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 transition-colors group-hover:bg-amber-200"
                                    >
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
                                            class="lucide lucide-phone h-5 w-5 text-amber-800"
                                        >
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <span class="text-amber-800">+1 234 567 890</span>
                                </div>
                                <div class="rt-Flex rt-r-ai-center group">
                                    <div
                                        class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 transition-colors group-hover:bg-amber-200"
                                    >
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
                                            class="lucide lucide-mail h-5 w-5 text-amber-800"
                                        >
                                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-amber-800">contact@scoutorg.com</span>
                                </div>
                                <div class="rt-Flex rt-r-ai-center group">
                                    <div
                                        class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 transition-colors group-hover:bg-amber-200"
                                    >
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
                                            class="lucide lucide-map-pin h-5 w-5 text-amber-800"
                                        >
                                            <path
                                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"
                                            ></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                    </div>
                                    <span class="text-amber-800">123 Scout Camp, Nature Valley</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="space-y-6">
                        <div class="">
                            <input
                                data-slot="input"
                                class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex h-9 w-full min-w-0 rounded-md border border-amber-200 bg-white/80 px-3 py-1 text-base shadow-xs backdrop-blur-sm transition-all duration-300 outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none focus-visible:ring-[3px] disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                placeholder="Your Name"
                                type="text"
                            />
                        </div>
                        <div class="">
                            <input
                                data-slot="input"
                                class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex h-9 w-full min-w-0 rounded-md border border-amber-200 bg-white/80 px-3 py-1 text-base shadow-xs backdrop-blur-sm transition-all duration-300 outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none focus-visible:ring-[3px] disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                placeholder="Your Email"
                                type="email"
                            />
                        </div>
                        <div class="">
                            <textarea
                                data-slot="textarea"
                                class="placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex field-sizing-content min-h-16 w-full resize-none rounded-md border border-amber-200 bg-white/80 px-3 py-2 text-base shadow-xs backdrop-blur-sm transition-all duration-300 outline-none focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                placeholder="Your Message"
                                rows="4"
                            ></textarea>
                        </div>
                        <button class="primary-button flex w-full items-center justify-center space-x-2">
                            <span>Send Message</span
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
                                class="lucide lucide-mail h-5 w-5"
                            >
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </Layout>
</template>

<style></style>
