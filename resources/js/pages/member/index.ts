import { GENDER } from '@/constants';
import { dateFormat, showToast } from '@/lib/utils';
import { BreadcrumbItem, Member, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default function Hook({ member }: { member?: Member }) {
    const page = usePage<SharedData>();
    const breadcrumbIndex: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Anggota Organisasi',
            href: '/dashboard/member',
        },
    ];
    const breadcrumbCreate: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Anggota Organisasi',
            href: '/dashboard/member',
        },
        {
            title: 'Tambah Anggota',
            href: '/dashboard/member/create',
        },
    ];
    const breadcrumbEdit: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Anggota Organisasi',
            href: '/dashboard/member',
        },
        {
            title: 'Edit Anggota',
            href: member ? `/dashboard/member/${member.id}/edit` : '',
        },
    ];

    const form = useForm({
        year: member ? member.year_id : '',
        grade: member ? member.grade_id : '',
        name: member ? member.name : '',
        phone: member ? member.phone : '',
        gender: member ? member.gender : '',
        birth_place: member ? member.birth_place : '',
        birth_date: member ? dateFormat(member.birth_date, 'yyyy-MM-DD') : '',
        address: member ? member.address : '',
        father_name: member ? member.father_name : '',
    });

    const handleCreate = () => {
        form.post(route('member.store'), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();

                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = (member: Member) => {
        Swal.fire({
            icon: 'question',
            title: 'Apakah kamu yakin?',
            text: "Jika iya, masukan 'delete' untuk konfirmasi",
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                required: 'required',
            },
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: 'hsl(0 84% 60%)',
            confirmButtonText: 'Hapus',
            showLoaderOnConfirm: true,
            preConfirm: async (login: string) => {
                if (login.toLowerCase() == 'delete') {
                    return true;
                } else {
                    Swal.showValidationMessage('Konfirmasi Salah!');
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('member.destroy', { id: member.id }), {
                    onSuccess: () => {
                        showToast(page?.props?.flash);
                    },
                });
            }
        });
    };

    const handleUpdate = () => {
        form.put(route('member.update', member?.id), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();

                showToast(page?.props?.flash);
            },
        });
    };

    showToast(page?.props?.flash);

    return {
        state: {
            breadcrumbIndex,
            breadcrumbCreate,
            breadcrumbEdit,
            genders: GENDER,
            form,
        },
        handler: {
            handleCreate,
            handleDelete,
            handleUpdate,
            dateFormat,
        },
    };
}
