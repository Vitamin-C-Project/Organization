<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { MainNavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Album, AlignJustify, Calendar, LayoutGrid, LetterText, List, ListCheck, ListEnd, ListOrdered, Settings, UserCheck } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

// const mainNavItems: NavItem[] = [
//     {
//         title: 'Dasbor',
//         href: '/dashboard',
//         icon: LayoutGrid,
//     },
//     {
//         title: 'Tahun Ajaran',
//         href: '/dashboard/academic-year',
//         icon: Calendar,
//     },
// ];

const mainMenu: MainNavItem[] = [
    {
        title: 'Main',
        menus: [
            {
                title: 'Dasbor',
                href: '/dashboard',
                icon: LayoutGrid,
            },
        ],
    },
    {
        title: 'Organisasi',
        menus: [
            {
                title: 'Anggota Organisasi',
                href: '/dashboard/member',
                icon: AlignJustify,
            },
            {
                title: 'Anggota Dewan',
                href: '/dashboard/membership',
                icon: ListCheck,
            },
            {
                title: 'Alumni',
                href: '/dashboard/alumni',
                icon: ListEnd,
            },
        ],
    },
    {
        title: 'Data Master',
        menus: [
            {
                title: 'Tahun Ajaran',
                href: '/dashboard/academic-year',
                icon: Calendar,
            },
            {
                title: 'Kelas',
                href: '/dashboard/grade',
                icon: List,
            },
            {
                title: 'Jabatan Organisasi',
                href: '/dashboard/position',
                icon: ListOrdered,
            },
        ],
    },
    {
        title: 'Aplikasi & Pengaturan',
        menus: [
            {
                title: 'Konfigurasi Aplikasi',
                href: '/dashboard/configs',
                icon: Settings,
            },
            {
                title: 'Artikel',
                href: '/dashboard/article',
                icon: LetterText,
            },
            {
                title: 'Galeri',
                href: '/dashboard/gallery',
                icon: Album,
            },
            {
                title: 'Akun Admin',
                href: '/dashboard/admins',
                icon: UserCheck,
            },
        ],
    },
];

// const footerNavItems: NavItem[] = [
//     {
//         title: 'Github Repo',
//         href: 'https://github.com/laravel/vue-starter-kit',
//         icon: Folder,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits#vue',
//         icon: BookOpen,
//     },
// ];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain v-for="(menu, index) in mainMenu" :items="menu.menus" :key="index" :title="menu.title" />
        </SidebarContent>

        <SidebarFooter>
            <!--            <NavFooter :items="footerNavItems" />-->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
