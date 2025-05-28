import { showToast } from '@/lib/utils';
import { BreadcrumbItem, Position, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';

export default function Hook() {
    const page = usePage<SharedData>();
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dasbor',
            href: '/dashboard',
        },
        {
            title: 'Jabatan Organisasi',
            href: '/dashboard/position',
        },
    ];
    const positionSelected = ref<Position>();
    const showDialog = ref({
        show: false,
        title: '',
        type: 1,
    });

    const handleShowDialog = (show: boolean, title: string, type?: number) => {
        form.reset();
        showDialog.value = {
            show: show,
            title: title,
            type: type || 1,
        };
    };

    const form = useForm({
        title: '',
        description: '',
        status: false,
    });

    const handleCreate = () => {
        form.post(route('position.store'), {
            preserveScroll: true,
            onFinish: () => {
                form.reset('status', 'description', 'title');
                handleShowDialog(false, '');

                showToast(page?.props?.flash);
            },
        });
    };

    const handleEdit = (position: Position) => {
        positionSelected.value = position;
        handleShowDialog(true, 'Edit Tahun Ajaran', 2);
        Object.assign(form, {
            title: position.title,
            description: position.description,
            status: position.status,
        });
    };

    const handleUpdate = () => {
        form.put(route('position.update', { id: positionSelected.value?.id }), {
            preserveScroll: true,
            onFinish: () => {
                form.reset('status', 'description', 'title');
                handleShowDialog(false, '');

                showToast(page?.props?.flash);
            },
        });
    };

    const handleUpdateStatus = (position: Position) => {
        form.put(route('position.update.status', { id: position.id }), {
            preserveScroll: true,
            onFinish: () => {
                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = (position: Position) => {
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
                router.delete(route('position.destroy', { id: position.id }), {
                    onFinish: () => {
                        showToast(page?.props?.flash);
                    },
                });
            }
        });
    };

    const handleSubmit = () => {
        if (showDialog.value.type == 1) {
            handleCreate();
        } else {
            handleUpdate();
        }
    };

    return {
        state: {
            breadcrumbs,
            showDialog,
            form,
        },
        handler: {
            handleShowDialog,
            handleCreate,
            handleUpdateStatus,
            handleUpdate,
            handleEdit,
            handleSubmit,
            handleDelete,
        },
    };
}
