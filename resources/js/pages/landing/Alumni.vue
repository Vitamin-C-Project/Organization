<script setup lang="ts">
import Layout from '@/layouts/landing/Layout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{}>();

const appName = import.meta.env.VITE_APP_NAME;
</script>

<template>
    <Head title="Alumni">
        <link rel="canonical" :href="route('landing.alumni.index')" />

        <meta name="description" :content="`Alumni - ${appName}`" />
        <meta name="keywords" :content="`Alumni - ${appName}`" itemprop="keywords" />
        <meta name="author" :content="'Admin'" />

        <meta :content="`Alumni - ${appName}`" itemprop="headline" />
        <meta :content="route('landing.alumni.index')" itemprop="url" />

        <meta property="og:type" content="article" />
        <meta property="og:title" :content="`Alumni - ${appName}`" />
        <meta property="og:description" :content="`Alumni - ${appName}`" />
        <meta property="og:url" :content="route('landing.alumni.index')" />
    </Head>

    <Layout> </Layout>
</template>

<style></style>
