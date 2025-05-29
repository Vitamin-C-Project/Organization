<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { MainNavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Album, AlignJustify, Calendar, LayoutGrid, LetterText, List, ListCheck, ListEnd, ListOrdered, Settings } from 'lucide-vue-next';
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
                href: 'dashboard',
                icon: LayoutGrid,
            },
        ],
    },
    {
        title: 'Organisasi',
        menus: [
            {
                title: 'Anggota Organisasi',
                href: 'member.index',
                icon: AlignJustify,
            },
            {
                title: 'Anggota Dewan',
                href: 'membership.index',
                icon: ListCheck,
            },
            {
                title: 'Alumni',
                href: 'alumni.index',
                icon: ListEnd,
            },
        ],
    },
    {
        title: 'Data Master',
        menus: [
            {
                title: 'Tahun Ajaran',
                href: 'academic.year.index',
                icon: Calendar,
            },
            {
                title: 'Kelas',
                href: 'grade.index',
                icon: List,
            },
            {
                title: 'Jabatan Organisasi',
                href: 'position.index',
                icon: ListOrdered,
            },
        ],
    },
    {
        title: 'Aplikasi & Pengaturan',
        menus: [
            {
                title: 'Konfigurasi Aplikasi',
                href: 'config.index',
                icon: Settings,
            },
            {
                title: 'Artikel',
                href: 'article.index',
                icon: LetterText,
            },
            {
                title: 'Galeri',
                href: 'gallery.index',
                icon: Album,
            },
            // {
            //     title: 'Akun Admin',
            //     href: '/dashboard/admins',
            //     icon: UserCheck,
            // },
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
