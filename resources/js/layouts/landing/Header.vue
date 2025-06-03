<script setup lang="ts">
import { findConfig } from '@/lib/utils';
import { Config, SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Menu, TreePineIcon, X } from 'lucide-vue-next';
import { ref } from 'vue';

const isMenuOpen = ref(false);

const page = usePage<SharedData>();

const menus = [
    {
        title: 'Tentang Kami',
        href: '/#about',
    },
    {
        title: 'Artikel',
        href: '/articles',
    },
    {
        title: 'Galeri',
        href: '/#gallery',
    },
    {
        title: 'Hubungi Kami',
        href: '/#contact',
    },
    {
        title: 'Alumni',
        href: '/alumni',
    },
];
</script>

<template>
    <div class="fixed top-0 z-50 w-full bg-white/90 shadow-md backdrop-blur-md">
        <div class="container mx-auto px-4">
            <div class="flex h-16 items-center justify-between">
                <Link href="/" class="group flex items-center space-x-2">
                    <img
                        :src="`/storage/${findConfig('app_image', page.props.configs as Config[])}`"
                        :alt="page.props.name"
                        class="h-8 w-8 transform transition-transform group-hover:rotate-12"
                        v-if="findConfig('app_image', page.props.configs as Config[])"
                    />
                    <TreePineIcon class="h-8 w-8 transform text-amber-800 transition-transform group-hover:rotate-12" v-else />
                    <span class="text-2xl font-bold text-amber-800">{{ page.props.name }}</span>
                </Link>
                <div class="hidden space-x-8 md:flex">
                    <Link class="nav-link" v-for="menu in menus" :key="menu.title" :href="menu.href">{{ menu.title }}</Link>
                </div>
                <button class="cursor-pointer md:hidden" @click="isMenuOpen = !isMenuOpen">
                    <X class="text-amber-800" :size="24" v-if="isMenuOpen" />
                    <Menu class="text-amber-800" :size="24" v-else />
                </button>
            </div>

            <div className="md:hidden absolute top-16 left-0 right-0 bg-white/90 backdrop-blur-md shadow-md animate-fade-in" v-if="isMenuOpen">
                <div className="flex flex-col p-4 space-y-4">
                    <Link class="nav-link" v-for="menu in menus" :key="menu.title" :href="menu.href">{{ menu.title }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>
