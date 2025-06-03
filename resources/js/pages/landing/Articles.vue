<script setup lang="ts">
import NotFoundPng from '@/assets/image/not-found.png';
import Pagination from '@/components/Pagination.vue';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import Layout from '@/layouts/landing/Layout.vue';
import { Article, MetaPagination } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { Calendar, ChevronRight, Search } from 'lucide-vue-next';
import moment from 'moment';
import { reactive, ref, watchEffect } from 'vue';

const props = defineProps<{ articles: MetaPagination; filters: any }>();

const filterData = reactive(props.filters);
const tableData = ref<Article[]>([]);
const metaPagination = ref<MetaPagination>();

watchEffect(() => {
    tableData.value = [...props.articles.data];
    metaPagination.value = props.articles;

    filterData.value = props.filters;
});

const onSearch = () => {
    router.get(route('articles'), { search: filterData.search }, { preserveState: true, replace: true });
};

const appName = import.meta.env.VITE_APP_NAME;
</script>

<template>
    <Head title="Kumpulan Artikel">
        <link rel="canonical" :href="route('articles')" />

        <meta name="description" :content="`Kumpulan Artikel - ${appName}`" />
        <meta name="keywords" :content="`Kumpulan Artikel - ${appName}`" itemprop="keywords" />
        <meta name="author" content="Admin" />

        <meta :content="`Kumpulan Artikel - ${appName}`" itemprop="headline" />
        <meta :content="route('articles')" itemprop="url" />

        <meta property="og:type" content="article" />
        <meta property="og:title" :content="`Kumpulan Artikel - ${appName}`" />
        <meta property="og:description" :content="`Kumpulan Artikel - ${appName}`" />
        <meta property="og:url" :content="route('articles')" />
    </Head>

    <Layout>
        <div class="min-h-screen bg-amber-50 pt-20">
            <div class="container mx-auto px-4 py-8">
                <div class="mb-12 text-center">
                    <h1 class="mb-4 text-4xl font-bold text-amber-900">Kumpulan Artikel</h1>
                    <p class="text-lg text-amber-700">Tetap terinformasi tentang aktivitas dan pencapaian terbaru kami</p>
                </div>

                <div class="mb-8 rounded-xl bg-white p-6 shadow-md">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="relative col-span-12 md:col-span-10">
                            <input
                                type="text"
                                placeholder="Cari Artikel..."
                                v-model="filterData.search"
                                class="h-full w-full rounded-lg border border-amber-200 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-amber-500 focus:outline-none"
                            />
                        </div>
                        <button
                            class="primary-button col-span-12 flex h-full w-full cursor-pointer items-center justify-center space-x-2 md:col-span-2"
                            @click="onSearch"
                        >
                            <Search :size="20" />
                            <span>Cari</span>
                        </button>
                    </div>
                </div>

                <div class="mb-10 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <Link
                        v-for="(article, index) in tableData"
                        :href="route('article.show', article.slug)"
                        :key="index"
                        class="overflow-hidden rounded-xl bg-white shadow-md transition-shadow duration-300 hover:shadow-xl"
                    >
                        <div class="relative h-48">
                            <img
                                :src="`/storage/${article.image}`"
                                :alt="article.title"
                                class="h-full w-full object-cover"
                                @error="($event: any) => ($event.target.src = NotFoundPng)"
                            />
                        </div>
                        <div class="p-6">
                            <div class="mb-2 flex items-center text-sm text-amber-600">
                                <Calendar class="mr-2 h-4 w-4" />
                                {{ moment(article.created_at).locale('id').format('DD MMMM YYYY') }}
                            </div>
                            <TooltipProvider>
                                <Tooltip>
                                    <TooltipTrigger as-child
                                        ><h3 class="mb-2 line-clamp-2 text-xl font-semibold text-amber-900">{{ article.title }}</h3></TooltipTrigger
                                    >
                                    <TooltipContent>
                                        <p>{{ article.title }}</p>
                                    </TooltipContent>
                                </Tooltip>
                            </TooltipProvider>

                            <p class="mb-4 line-clamp-2 text-sm text-amber-700" v-html="article.content"></p>
                            <div class="group flex items-center text-amber-800">
                                <span>Selengkapnya</span>
                                <ChevronRight class="ml-2 h-4 w-4 transform transition-transform group-hover:translate-x-1" />
                            </div>
                        </div>
                    </Link>
                </div>

                <Pagination :meta-pagination="metaPagination!" />

                <div class="py-12 text-center" v-if="tableData.length < 1">
                    <p class="text-lg text-amber-800">No news articles found matching your criteria.</p>
                </div>
            </div>
        </div>
    </Layout>
</template>
