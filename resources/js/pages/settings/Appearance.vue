<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Tema Tampilan',
        href: '/settings/appearance',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Pengaturan Tema Tampilan" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Tema Tampilan" description="Memperbarui pengaturan tampilan akun Anda" />
                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
