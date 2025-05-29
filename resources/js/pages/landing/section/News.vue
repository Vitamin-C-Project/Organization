<script lang="ts" setup>
import { Article } from '@/types';
import { Link } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';
import moment from 'moment';
import 'moment/locale/id';

import NotFoundPng from '@/assets/image/not-found.png';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';

defineProps<{ articles: Article[] }>();
</script>

<template>
    <section id="news" class="bg-amber-50/50 py-20">
        <div class="container mx-auto px-4">
            <h2 class="!mb-12 text-center text-3xl font-bold text-white">Artikel Terbaru</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div v-for="article in articles" :key="article.id" class="news-card">
                    <div class="relative overflow-hidden">
                        <img
                            alt="National Jamboree 2024"
                            class="h-48 w-full object-cover transition-transform duration-300 hover:scale-110"
                            :src="`/storage/${article.image}`"
                            @error="($event: any) => ($event.target.src = NotFoundPng)"
                        />
                    </div>
                    <div class="p-6">
                        <span class="!mb-2 text-sm text-amber-700">{{ moment(article.created_at).locale('id').format('DD MMMM YYYY') }}</span>
                        <TooltipProvider>
                            <Tooltip>
                                <TooltipTrigger as-child
                                    ><h3 class="!mb-2 line-clamp-2 text-xl font-semibold text-amber-900">{{ article.title }}</h3></TooltipTrigger
                                >
                                <TooltipContent>
                                    <p>{{ article.title }}</p>
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>

                        <p class="!mb-4 line-clamp-2 text-sm text-amber-700" v-html="article.content"></p>
                        <Link :href="`/${article.slug}`" class="group flex items-center space-x-2 text-amber-800 hover:text-amber-600">
                            <span class="rt-Text">Selengkapnya</span><ChevronRight :size="16" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
