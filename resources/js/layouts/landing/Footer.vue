<script setup lang="ts">
const appName = import.meta.env.VITE_APP_NAME;
</script>

<template>
    <footer class="relative bg-amber-900 py-5 text-white">
        <div class="bg-texture absolute inset-0 opacity-5"></div>
        <div class="relative container mx-auto px-4">
            <div class="border-t border-amber-800/50 text-center">
                <span class="text-amber-200/80">&copy; {{ new Date().getFullYear() }} {{ appName }}. All rights reserved.</span>
            </div>
        </div>
    </footer>
</template>
