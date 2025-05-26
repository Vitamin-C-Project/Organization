<script setup lang="ts">
import Layout from '@/layouts/landing/Layout.vue';
import { Config } from '@/types';
import { Head } from '@inertiajs/vue3';
import About from './section/About.vue';
import Contact from './section/Contact.vue';
import Gallery from './section/Gallery.vue';
import Home from './section/Home.vue';
import News from './section/News.vue';

defineProps<{ configs: Config[] }>();
</script>

<template>
    <Head title="Selamat Datang" />
    <Layout>
        <Home :configs="configs" />
        <About :configs="configs" />
        <News />
        <Gallery />
        <Contact />
    </Layout>
</template>

<style></style>
