<script lang="ts" setup>
import InputError from '@/components/InputError.vue';
import { findConfig, showToast } from '@/lib/utils';
import { Config, SharedData } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { Mail, MapPin, Phone, Send } from 'lucide-vue-next';

defineProps<{ configs: Config[] }>();
const page = usePage<SharedData>();

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const handleSubmit = () => {
    form.post(route('contact.store'), {
        onSuccess: () => {
            form.reset();

            showToast(page?.props?.flash);
        },
    });
};
</script>

<template>
    <section id="contact" class="relative bg-amber-50/50 py-20">
        <div class="bg-texture absolute inset-0 opacity-5"></div>
        <div class="relative container mx-auto px-4">
            <h1 class="!mb-12 text-center text-3xl font-bold text-white">Hubungi Kami</h1>
            <div class="grid grid-cols-1 gap-9 md:grid-cols-2">
                <div class="rounded-lg bg-white/80 p-8 shadow-lg backdrop-blur-sm">
                    <div class="mb-8">
                        <h1 class="!mb-4 text-xl font-semibold text-amber-900">Hubungi Kami</h1>
                        <div class="space-y-4">
                            <div class="group flex items-center">
                                <div
                                    class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 transition-colors group-hover:bg-amber-200"
                                >
                                    <Phone class="h-5 w-5 text-amber-800" />
                                </div>
                                <span class="text-amber-800">{{ findConfig('contact_phone', configs) }}</span>
                            </div>
                            <div class="group flex items-center">
                                <div
                                    class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 transition-colors group-hover:bg-amber-200"
                                >
                                    <Mail class="h-5 w-5 text-amber-800" />
                                </div>
                                <span class="text-amber-800">{{ findConfig('contact_email', configs) }}</span>
                            </div>
                            <div class="group flex items-center">
                                <div
                                    class="mr-4 flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 transition-colors group-hover:bg-amber-200"
                                >
                                    <MapPin class="h-5 w-5 text-amber-800" />
                                </div>
                                <span class="text-amber-800">{{ findConfig('contact_address', configs) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="space-y-6" @submit.prevent="handleSubmit">
                    <div class="">
                        <input
                            data-slot="input"
                            class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex h-9 w-full min-w-0 rounded-md border border-amber-200 bg-white/80 px-3 py-1 text-base shadow-xs backdrop-blur-sm transition-all duration-300 outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none focus-visible:ring-[3px] disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            placeholder="Nama Lengkap"
                            type="text"
                            autocomplete="year"
                            v-model="form.name"
                            :disabled="form.processing"
                            required
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="">
                        <input
                            data-slot="input"
                            class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex h-9 w-full min-w-0 rounded-md border border-amber-200 bg-white/80 px-3 py-1 text-base shadow-xs backdrop-blur-sm transition-all duration-300 outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none focus-visible:ring-[3px] disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            placeholder="Email"
                            type="email"
                            v-model="form.email"
                            :disabled="form.processing"
                            required
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="">
                        <textarea
                            data-slot="textarea"
                            class="placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex field-sizing-content min-h-16 w-full resize-none rounded-md border border-amber-200 bg-white/80 px-3 py-2 text-base shadow-xs backdrop-blur-sm transition-all duration-300 outline-none focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            placeholder="Pesan"
                            rows="4"
                            v-model="form.message"
                            :disabled="form.processing"
                            required
                        ></textarea>
                        <InputError :message="form.errors.message" />
                    </div>
                    <button
                        class="primary-button flex w-full cursor-pointer items-center justify-center space-x-2"
                        type="submit"
                        :disabled="form.processing"
                    >
                        <span>Kirim Pesan</span><Send class="h-5 w-5" />
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>
