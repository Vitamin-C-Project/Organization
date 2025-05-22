<script setup lang="ts">
import { Award, Compass, Copy, Mountain } from 'lucide-vue-next';
</script>

<template>
    <footer class="relative bg-amber-900 py-12 text-white">
        <div class="bg-texture absolute inset-0 opacity-5"></div>
        <div class="relative container mx-auto px-4">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div class="">
                    <h1 class="!mb-4 flex items-center space-x-2 text-xl font-bold"><Compass /><span class="rt-Text">Scout Programs</span></h1>
                    <div class="space-y-2">
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Cub Scouts</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Boy Scouts</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Venture Scouts</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Sea Scouts</p>
                    </div>
                </div>
                <div class="">
                    <h1 class="!mb-4 flex items-center space-x-2 text-xl font-bold"><Mountain /><span class="rt-Text">Activities</span></h1>
                    <div class="space-y-2">
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Camping</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Hiking</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Leadership Training</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Community Service</p>
                    </div>
                </div>
                <div class="">
                    <h1 class="!mb-4 flex items-center space-x-2 text-xl font-bold"><Award /><span class="rt-Text">Resources</span></h1>
                    <div class="space-y-2">
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Scout Handbook</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Merit Badges</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Events Calendar</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Training Center</p>
                    </div>
                </div>
                <div class="">
                    <h1 class="!mb-4 flex items-center space-x-2 text-xl font-bold"><Copy /><span class="rt-Text">Connect With Us</span></h1>
                    <div class="space-y-2">
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Facebook</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Instagram</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">Twitter</p>
                        <p class="!mb-2 cursor-pointer transition-colors hover:text-amber-200">YouTube</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-amber-800/50 pt-8 text-center">
                <span class="text-amber-200/80">© 2024 Scout Organization. All rights reserved.</span>
            </div>
        </div>
    </footer>
</template>
