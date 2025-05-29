<script lang="ts" setup>
import { Toaster } from '@/components/ui/toast';
import Footer from './Footer.vue';
import Header from './Header.vue';
</script>

<template>
    <div
        class="font-fira-code absolute top-0 z-0 min-h-[100dvh] w-full border-b bg-black bg-[linear-gradient(to_right,#80808033_1px,transparent_1px),linear-gradient(to_bottom,#80808033_1px,transparent_1px)] bg-[size:70px_70px]"
    >
        <div class="relative">
            <Toaster />
            <Header />
            <slot />
            <Footer />
        </div>
    </div>
</template>
