<script setup lang="ts">
import Layout from '@/layouts/landing/Layout.vue';
import { Article, Config, Gallery as GalleryType } from '@/types';
import { Head } from '@inertiajs/vue3';
import About from './section/About.vue';
import Contact from './section/Contact.vue';
import Gallery from './section/Gallery.vue';
import Home from './section/Home.vue';
import News from './section/News.vue';

defineProps<{
    configs: Config[];
    articles: Article[];
    galleries: GalleryType[];
    countMember: number;
    countMembership: number;
    countAlumni: number;
}>();
</script>

<template>
    <Head title="Selamat Datang" />
    <Layout>
        <Home :configs="configs" :countMember="countMember" :countMembership="countMembership" :countAlumni="countAlumni" />
        <About :configs="configs" />
        <News :articles="articles" />
        <Gallery :galleries="galleries" />
        <Contact :configs="configs" />
    </Layout>
</template>

<style></style>
