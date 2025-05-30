<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Contact } from '@/types';
import { Check, Trash } from 'lucide-vue-next';

defineProps<{
    contact: Contact;
}>();

defineEmits<{
    (e: 'edit', contact: Contact): void;
    (e: 'delete', contact: Contact): void;
}>();
</script>

<template>
    <div class="flex items-center justify-end gap-3">
        <Button variant="outline" @click="$emit('edit', contact)" size="sm" v-if="!contact.status"> <Check /> Jadikan sudah dibaca </Button>
        <Button variant="destructive" @click="$emit('delete', contact)" size="sm" v-if="contact.status"> <Trash /> Hapus </Button>
    </div>
</template>

<style scoped></style>
