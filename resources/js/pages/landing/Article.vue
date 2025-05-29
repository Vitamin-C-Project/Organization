<script setup lang="ts">
import NotFoundPng from '@/assets/image/not-found.png';
import Layout from '@/layouts/landing/Layout.vue';
import { cn } from '@/lib/utils';
import { Article } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, Calendar, User } from 'lucide-vue-next';
import moment from 'moment';

const props = defineProps<{ article: Article }>();
const appUrl = import.meta.env.VITE_APP_URL;
</script>

<template>
    <Head title="Artikel tidak ditemukan" v-if="!article" />
    <Head :title="article.title" v-if="article">
        <link rel="canonical" :href="route('article.show', article.slug)" />

        <meta name="description" :content="article.content" />
        <meta name="keywords" :content="article.title" itemprop="keywords" />
        <meta name="author" :content="article.created_by" />

        <meta :content="article.title" itemprop="headline" />
        <meta :content="route('article.show', article.slug)" itemprop="url" />

        <meta property="og:type" content="article" />
        <meta property="og:title" :content="article.title" />
        <meta property="og:description" :content="article.content" />
        <meta property="og:url" :content="route('article.show', article.slug)" />
        <meta property="og:image" :content="`${appUrl}/storage/${article.image}`" />
    </Head>
    <Layout>
        <div :class="cn(article && 'bg-white pt-16')">
            <div className="min-h-screen bg-amber-50/70 flex items-center justify-center" v-if="!article">
                <div className="text-center">
                    <h2 className="text-2xl font-bold text-amber-900 mb-4">Artikel tidak ditemukan</h2>
                    <Link :href="route('articles')" className="text-amber-700 hover:text-amber-900 flex items-center justify-center gap-2">
                        <ArrowLeft :size="20" />
                        <span>Kembali</span>
                    </Link>
                </div>
            </div>

            <div class="min-h-screen bg-amber-50/50" v-if="article">
                <div class="container mx-auto px-4 py-8">
                    <Link :href="route('articles')" class="group mb-8 inline-flex items-center text-amber-700 hover:text-amber-900">
                        <ArrowLeft class="mr-2 h-5 w-5 transition-transform group-hover:-translate-x-1" />
                        <span>Kembali</span>
                    </Link>

                    <div class="relative mb-8 h-[400px] overflow-hidden rounded-xl">
                        <img
                            :src="`/storage/${article.image}`"
                            alt="{news.title}"
                            class="h-full w-full object-cover"
                            @error="($event: any) => ($event.target.src = NotFoundPng)"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent" />
                    </div>

                    <div class="mx-auto max-w-4xl">
                        <div class="mb-8">
                            <h1 class="mb-4 text-xl font-bold text-amber-900 md:text-2xl lg:text-3xl">{{ article.title }}</h1>
                            <div class="flex flex-wrap gap-4 text-amber-700">
                                <div class="flex items-center gap-2">
                                    <Calendar class="h-4 w-4" />
                                    <span>{{ moment(article.created_at).locale('id').format('DD MMMM YYYY') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <User class="h-4 w-4" />
                                    <span>{{ article.created_by }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="prose prose-amber max-w-none">
                            <p class="mb-6 leading-relaxed text-amber-800" v-html="article.content"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
