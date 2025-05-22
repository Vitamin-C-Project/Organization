<script setup lang="ts"></script>

<template>
    <div class="fixed top-0 z-50 w-full bg-white/90 shadow-md backdrop-blur-md">
        <div class="container mx-auto px-4">
            <div class="flex h-16 items-center justify-between">
                <div class="group flex items-center space-x-2">
                    <TreePineIcon class="h-8 w-8 transform text-amber-800 transition-transform group-hover:rotate-12" />
                    <span class="text-2xl font-bold text-amber-800">Pramuka Wanakerti</span>
                </div>
                <div class="hidden space-x-8 md:flex">
                    <button class="nav-link">Home</button>
                    <button class="nav-link">About</button>
                    <button class="nav-link">News</button>
                    <button class="nav-link">Gallery</button>
                    <button class="nav-link text-amber-600">Contact</button>
                </div>
                <button class="md:hidden">
                    <Menu class="text-amber-800" />
                </button>
            </div>
        </div>
    </div>
</template>
