import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface MainNavItem {
    title: string;
    menus: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface Pagination {
    active: boolean;
    label: string;
    url: string | null;
}

export interface MetaPagination {
    current_page: number;
    last_page: number;
    from: number;
    per_page: number;
    to: number;
    total: number
    links: Pagination[];
}

interface Common {
    id: number;
    created_at?: string;
    updated_at?: string;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface AcademicYear extends Common{
    title: string;
    passcode: string;
    status: boolean
}

export interface Grade  extends  Common {
    class: string;
    major: string;
}

export interface Position extends  Common {
    title: string;
    description: string;
    status: boolean;
    parent: null;
}

export type BreadcrumbItemType = BreadcrumbItem;
