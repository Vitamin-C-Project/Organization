import { showToast } from '@/lib/utils';
import { BreadcrumbItem, Membership, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';

export default function Hook({ member }: { member?: Membership }) {
    const page = usePage<SharedData>();
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dasbor',
            href: route('dashboard'),
        },
        {
            title: 'Anggota Dewan',
            href: route('membership.index'),
        },
    ];
    const showDialog = ref({
        show: false,
        title: '',
        type: 1,
    });
    const memberSelected = ref<Membership>();

    const form = useForm({
        member: member ? member.member_id : '',
        year: member ? member.year_id : '',
        position: member ? member.position_id : '',
        status: member ? member.status : true,
    });

    const handleShowDialog = (show: boolean, title: string, type?: number) => {
        form.reset();
        showDialog.value = {
            show: show,
            title: title,
            type: type || 1,
        };
    };

    const handleCreate = () => {
        form.post(route('membership.store'), {
            onSuccess: () => {
                form.reset();

                showDialog.value = {
                    show: false,
                    title: '',
                    type: 1,
                };

                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = (member: Membership) => {
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
                router.delete(route('membership.destroy', { id: member.id }), {
                    onSuccess: () => {
                        showToast(page?.props?.flash);
                    },
                });
            }
        });
    };

    const handleUpdate = () => {
        form.put(route('membership.update', memberSelected.value?.id), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();

                showDialog.value = {
                    show: false,
                    title: '',
                    type: 1,
                };

                showToast(page?.props?.flash);
            },
        });
    };

    const handleTransfer = (member: Membership) => {
        Swal.fire({
            icon: 'question',
            title: 'Apakah kamu yakin?',
            html: "<p>Data anggota dan dewan akan dihapus dan dipindahkan ke alumni. <br /><br /> Jika iya, masukan <strong>'transfer'</strong> untuk konfirmasi</p>",
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                required: 'required',
            },
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonColor: 'hsl(0 84% 60%)',
            confirmButtonText: 'Pindah',
            showLoaderOnConfirm: true,
            preConfirm: async (login: string) => {
                if (login.toLowerCase() == 'transfer') {
                    return true;
                } else {
                    Swal.showValidationMessage('Konfirmasi Salah!');
                }
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                router.put(
                    route('membership.transfer', { id: member.id }),
                    {},
                    {
                        onSuccess: () => {
                            return showToast(page?.props?.flash);
                        },
                    },
                );
            }
        });
    };

    const handleEdit = (member: Membership) => {
        handleShowDialog(true, 'Edit Anggota', 2);
        Object.assign(form, {
            member: member.member_id,
            year: member.year_id,
            position: member.position_id,
            status: member.status,
        });
        memberSelected.value = member;
    };

    const handleSubmit = () => {
        if (showDialog.value.type == 1) {
            handleCreate();
        } else {
            handleUpdate();
        }
    };

    showToast(page?.props?.flash);

    return {
        state: { breadcrumbs, form, showDialog, memberSelected },
        handler: { handleCreate, handleDelete, handleUpdate, handleEdit, handleSubmit, handleTransfer, handleShowDialog },
    };
}
