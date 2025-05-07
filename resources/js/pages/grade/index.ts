import { Grade, BreadcrumbItem, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { showToast } from '@/lib/utils';
import Swal from 'sweetalert2';

export default function Hook() {
    const page = usePage<SharedData>()
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Kelas',
            href: '/dashboard/grade',
        },
    ];

    const gradeSelection = ref<Grade>()
    const showDialog = ref({
        show: false,
        title: '',
        type: 1,
    });

    const handleShowDialog = (show: boolean, title: string, type?: number) => {
        form.reset()
        showDialog.value = {
            show: show,
            title: title,
            type: type || 1,
        };
    };

    const form = useForm({
        class: '',
        major: '-',
    });

    const handleCreate = () => {
        form.post(route('grade.store'), {
            preserveScroll: true,
            onFinish: () => {
                form.reset('class');
                handleShowDialog(false, '');

                showToast(page?.props?.flash)
            },
        });
    };

    const handleEdit = (grade: Grade) => {
        gradeSelection.value = grade
        handleShowDialog(true, 'Edit Kelas', 2)
        Object.assign(form, {
            class: grade.class,
        })
    }

    const handleUpdate = () => {
        form.put(route('grade.update', {id: gradeSelection.value?.id}), {
            preserveScroll: true,
            onFinish: () => {
                form.reset('class');
                handleShowDialog(false, '');

                showToast(page?.props?.flash)
            },
        });
    }

    const handleUpdateStatus = (grade: Grade) => {
        form.put(route('grade.update.status', {id: grade.id}), {
            preserveScroll: true,
            onFinish: () => {
                showToast(page?.props?.flash)
            }
        });
    };

    const handleDelete = (grade: Grade) => {
        Swal.fire({
            icon: 'question',
            title: "Apakah kamu yakin?",
            text: "Jika iya, masukan 'delete' untuk konfirmasi",
            input: "text",
            inputAttributes: {
                autocapitalize: "off",
                required: "required"
            },
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonColor: "hsl(0 84% 60%)",
            confirmButtonText: "Hapus",
            showLoaderOnConfirm: true,
            preConfirm: async (login: string) => {
                if (login.toLowerCase() == 'delete') {
                    return true;
                } else {
                    Swal.showValidationMessage("Konfirmasi Salah!")
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('grade.destroy', {id: grade.id}), {
                    onFinish: () => {
                        showToast(page?.props?.flash)
                    }
                })
            }
        });
    }

    const handleSubmit = () => {
        if (showDialog.value.type == 1) {
            handleCreate()
        } else {
            handleUpdate()
        }
    }

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
            handleDelete
        },
    };
}
