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
    data?: any;
    current_page: number;
    last_page: number;
    from: number;
    per_page: number;
    to: number;
    total: number;
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

export interface AcademicYear extends Common {
    title: string;
    passcode: string;
    status: boolean;
}

export interface Grade extends Common {
    class: string;
    major: string;
}

export interface Position extends Common {
    title: string;
    description: string;
    status: boolean;
    parent: null;
}

export interface Member extends Common {
    year_id: number;
    grade_id: number;
    name: string;
    phone: string;
    gender: string;
    birth_place: string;
    birth_date: string;
    address: string;
    father_name: string;
    status: boolean;
    is_membership: boolean;
    created_by: string;
    grade?: Grade;
    year?: AcademicYear;
    membership?: Membership;
}

export interface Alumni extends Common {
    membership_id: number;
    member_id: number;
    destination_name?: string;
    appointment?: string;
    graduation_year?: string;
    type: number;
    status: boolean;
    member?: Member;
    membership?: Membership;
}

export interface Membership extends Common {
    member_id: number;
    year_id: number;
    position_id: number;
    status: boolean;
    year?: AcademicYear;
    member?: Member;
    position?: Position;
}

export interface Config extends Common {
    key: string;
    value: string;
    type: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
