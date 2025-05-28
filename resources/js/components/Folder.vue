<script setup lang="ts">
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { cn } from '@/lib/utils';
import { Album } from '@/types';
import { router } from '@inertiajs/vue3';
import { MoreHorizontal } from 'lucide-vue-next';
import Switch from './Switch.vue';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from './ui/dropdown-menu';

const props = defineProps<{
    album: Album;
}>();

defineEmits<{
    (e: 'edit', album: Album): void;
    (e: 'delete', album: Album): void;
    (e: 'updateStatus', album: Album): void;
}>();

const getRandomColor = () => {
    const colors = ['fill-rose-500', 'fill-green-500', 'fill-blue-500', 'fill-yellow-500', 'fill-purple-500', 'fill-orange-500', 'fill-red-500'];
    const randomIndex = Math.floor(props.album.title.length * Math.random()) % colors.length;

    return colors[randomIndex];
};

const redirect = (album: Album) => {
    router.visit(route('gallery.show', { slug: album.slug }));
};
</script>

<template>
    <div class="flex w-full flex-col gap-3 rounded-lg border bg-white p-4 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="cursor-pointer" @click="redirect(album)">
                <svg xmlns="http://www.w3.org/2000/svg" :class="cn('h-12 w-12', getRandomColor())" data-name="Layer 1" viewBox="0 0 24 24">
                    <path
                        opacity="1"
                        d="M19.97586,10V9a3,3,0,0,0-3-3H10.69678l-.31622-.94868A3,3,0,0,0,7.53451,3H3.97586a3,3,0,0,0-3,3V19a2,2,0,0,0,2,2H3.3067a2,2,0,0,0,1.96774-1.64223l1.40283-7.71554A2,2,0,0,1,8.645,10Z"
                    ></path>
                    <path
                        opacity="0.3"
                        d="M22.02386,10H8.645a2,2,0,0,0-1.96777,1.64221L5.27441,19.35773A2,2,0,0,1,3.3067,21H19.55292a2,2,0,0,0,1.96771-1.64227l1.48712-8.17884A1,1,0,0,0,22.02386,10Z"
                    ></path>
                </svg>
            </div>

            <DropdownMenu>
                <DropdownMenuTrigger class="cursor-pointer"><MoreHorizontal /></DropdownMenuTrigger>
                <DropdownMenuContent>
                    <DropdownMenuItem @click="redirect(album)">Lihat Album</DropdownMenuItem>
                    <DropdownMenuItem @click="$emit('edit', album)">Edit Album</DropdownMenuItem>
                    <DropdownMenuItem @click="$emit('delete', album)">Hapus Album</DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </div>

        <div class="flex cursor-pointer items-center justify-between gap-2">
            <div @click="redirect(album)">
                <h3 class="text-sm font-medium text-gray-800">{{ album.title }}</h3>
                <p class="text-xs text-gray-500">{{ album.totalFile }} File</p>
            </div>
            <div>
                <TooltipProvider>
                    <Tooltip>
                        <TooltipTrigger><Switch v-model="album.status" @update:model-value="$emit('updateStatus', album)" /></TooltipTrigger>
                        <TooltipContent>
                            <p>Munculkan Halaman Depan</p>
                        </TooltipContent>
                    </Tooltip>
                </TooltipProvider>
            </div>
        </div>
    </div>
</template>
