<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Membership } from '@/types';
import { router } from '@inertiajs/vue3';
import { ArrowDown, ArrowLeftRight, Edit, Trash, UserPen } from 'lucide-vue-next';

defineProps<{
    member: Membership;
}>();

defineEmits<{
    (e: 'edit', member: Membership): void;
    (e: 'transfer', member: Membership): void;
    (e: 'delete', member: Membership): void;
}>();
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="outline" size="sm">
                <span class="sr-only">Open menu</span>
                <ArrowDown class="h-4 w-4" /> Pilih Aksi
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuItem class="cursor-pointer" @click="$emit('edit', member)"> <Edit /> Edit Jabatan </DropdownMenuItem>
            <DropdownMenuItem class="cursor-pointer" @click="router.visit(route('member.edit', member.member_id))">
                <UserPen /> Edit Profil
            </DropdownMenuItem>
            <DropdownMenuItem class="cursor-pointer" @click="$emit('transfer', member)"> <ArrowLeftRight /> Jadikan Alumni </DropdownMenuItem>
            <DropdownMenuItem class="cursor-pointer" @click="$emit('delete', member)"> <Trash /> Hapus Anggota </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<style scoped></style>
