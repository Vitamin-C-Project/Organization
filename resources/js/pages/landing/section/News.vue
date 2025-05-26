<script lang="ts" setup></script>

<template>
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
</template>
