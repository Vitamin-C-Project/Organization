<script lang="ts" setup></script>

<template>
    <section id="contact" class="relative bg-amber-50/50 py-20">
        <div class="bg-texture absolute inset-0 opacity-5"></div>
        <div class="relative container mx-auto px-4">
            <h1 class="!mb-12 text-center text-3xl font-bold text-white">Contact Us</h1>
            <div class="grid grid-cols-1 gap-9 md:grid-cols-2">
                <div class="rounded-lg bg-white/80 p-8 shadow-lg backdrop-blur-sm">
                    <div class="mb-8">
                        <h1 class="!mb-4 text-xl font-semibold text-amber-900">Get in Touch</h1>
                        <div class="space-y-4">
                            <div class="group flex items-center">
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
                            <div class="group flex items-center">
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
                            <div class="group flex items-center">
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
</template>
