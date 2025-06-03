<script setup lang="ts">
import Layout from '@/layouts/landing/Layout.vue';
import { Article, Config, Gallery as GalleryType } from '@/types';
import { Head } from '@inertiajs/vue3';
import About from './section/About.vue';
import Contact from './section/Contact.vue';
import Gallery from './section/Gallery.vue';
import Home from './section/Home.vue';
import News from './section/News.vue';

const props = defineProps<{
    configs: Config[];
    articles: Article[];
    galleries: GalleryType[];
    countMember: number;
    countMembership: number;
    countAlumni: number;
}>();

const appName = import.meta.env.VITE_APP_NAME;
</script>

<template>
    <Head title="Selamat Datang">
        <link rel="canonical" :href="route('home')" />

        <meta name="description" :content="`Selamat Datang - ${appName}`" />
        <meta name="keywords" :content="`Selamat Datang - ${appName}`" itemprop="keywords" />
        <meta name="author" :content="'Admin'" />

        <meta :content="`Selamat Datang - ${appName}`" itemprop="headline" />
        <meta :content="route('home')" itemprop="url" />

        <meta property="og:type" content="article" />
        <meta property="og:title" :content="`Selamat Datang - ${appName}`" />
        <meta property="og:description" :content="`Selamat Datang - ${appName}`" />
        <meta property="og:url" :content="route('home')" />
    </Head>

    <Layout>
        <Home :configs="configs" :countMember="countMember" :countMembership="countMembership" :countAlumni="countAlumni" />
        <About :configs="configs" />
        <News :articles="articles" />
        <Gallery :galleries="galleries" />
        <Contact :configs="configs" />
    </Layout>
</template>

<style></style>
