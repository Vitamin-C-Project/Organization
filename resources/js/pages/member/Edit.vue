<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button, buttonVariants } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import Hook from '@/pages/member/index';
import { AcademicYear, Grade, Member } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ChevronLeftCircle, Send } from 'lucide-vue-next';

const props = defineProps<{ year: AcademicYear; grades: Grade[]; member: Member }>();

const { state, handler } = Hook({
    year: props.year,
    member: props.member,
});
</script>

<template>
    <Head :title="`Edit Anggota ${member.name}`" />

    <AppLayout :breadcrumbs="state.breadcrumbs">
        <div class="mx-auto mt-5 w-full max-w-4xl">
            <form action="" method="post" @submit.prevent="handler.handleUpdate">
                <Card>
                    <CardHeader>
                        <div class="flex items-center justify-between space-y-2">
                            <h2 class="text-2xl font-bold tracking-tight">Edit Anggota {{ member.name }}</h2>
                        </div>
                    </CardHeader>
                    <CardContent>
                        <div class="mb-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="grid gap-2">
                                <Label for="name">Nama Lengkap</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    autofocus
                                    autocomplete="name"
                                    placeholder="misal: Asep Saepullah"
                                    v-model="state.form.name"
                                    :disabled="state.form.processing"
                                />
                                <InputError :message="state.form.errors.name" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="year">Kelas</Label>
                                <Select :disabled="state.form.processing" @update:model-value="state.form.grade = $event">
                                    <SelectTrigger>
                                        <SelectValue :placeholder="grades.find((grade) => grade.id === member.grade_id)?.class || 'Pilih Kelas'" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectItem v-for="(grade, index) in grades" :key="index" :value="grade.id" class="cursor-pointer">
                                                {{ grade.class }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError :message="state.form.errors.grade" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="phone">No WA/Telepon</Label>
                                <Input
                                    id="phone"
                                    type="text"
                                    autocomplete="phone"
                                    placeholder="misal: 6289123456789"
                                    v-model="state.form.phone"
                                    :disabled="state.form.processing"
                                />
                                <InputError :message="state.form.errors.phone" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="gender">Jenis Kelamin</Label>
                                <Select :disabled="state.form.processing" @update:model-value="state.form.gender = $event">
                                    <SelectTrigger>
                                        <SelectValue
                                            :placeholder="
                                                state.genders.find((gender) => gender.key === member.gender)?.value || 'Pilih Jenis Kelamin'
                                            "
                                        />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectItem
                                                v-for="(gender, index) in state.genders"
                                                :key="index"
                                                :value="gender.key"
                                                class="cursor-pointer"
                                            >
                                                {{ gender.value }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>
                                <InputError :message="state.form.errors.gender" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="birth_place">Tempat Lahir</Label>
                                <Input
                                    id="birth_place"
                                    type="text"
                                    autocomplete="birth_place"
                                    placeholder="misal: Indramayu"
                                    v-model="state.form.birth_place"
                                    :disabled="state.form.processing"
                                />
                                <InputError :message="state.form.errors.birth_place" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="birth_date">Tanggal Lahir</Label>
                                <Input
                                    id="birth_date"
                                    type="date"
                                    autocomplete="birth_date"
                                    v-model="state.form.birth_date"
                                    :disabled="state.form.processing"
                                />
                                <InputError :message="state.form.errors.birth_date" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="father_name">Nama Orang Tua</Label>
                                <Input
                                    id="father_name"
                                    type="text"
                                    autocomplete="father_name"
                                    placeholder="misal: Ujang Sanjaya"
                                    v-model="state.form.father_name"
                                    :disabled="state.form.processing"
                                />
                                <InputError :message="state.form.errors.father_name" />
                            </div>
                            <div class="col-span-2 grid gap-2">
                                <Label for="address">Alamat Lengkap</Label>
                                <Textarea
                                    id="address"
                                    type="text"
                                    autocomplete="address"
                                    placeholder="misal: Jl. Raya Pantura, RT 004/RW 001, Losarang, Indramayu, Jawa Barat"
                                    v-model="state.form.address"
                                    :disabled="state.form.processing"
                                />
                                <InputError :message="state.form.errors.address" />
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter class="justify-between">
                        <Link
                            :href="route('member.index')"
                            :class="cn(buttonVariants({ variant: 'secondary' }), state.form.processing && 'cursor-not-allowed')"
                            ><ChevronLeftCircle /> Kembali</Link
                        >
                        <Button :disabled="state.form.processing">
                            <Send />
                            Simpan
                        </Button>
                    </CardFooter>
                </Card>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped></style>
