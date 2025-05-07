import { AcademicYear, BreadcrumbItem, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { showToast } from '@/lib/utils';
import Swal from "sweetalert2"

export default function Hook() {
    const page = usePage<SharedData>()
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Tahun Ajaran',
            href: '/dashboard/academic-year',
        },
    ];
    const yearSelected = ref<AcademicYear>()
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
        title: '',
        passcode: '',
        status: false,
    });

    const handleCreate = () => {
        form.post(route('academic.year.store'), {
            preserveScroll: true,
            onFinish: () => {
                form.reset('status', 'passcode', 'title');
                handleShowDialog(false, '');

                showToast(page?.props?.flash)
            },
        });
    };

    const handleEdit = (year: AcademicYear) => {
        yearSelected.value = year
        handleShowDialog(true, 'Edit Tahun Ajaran', 2)
        Object.assign(form, {
            title: year.title,
            passcode: year.passcode,
            status: year.status,
        })
    }

    const handleUpdate = () => {
        form.put(route('academic.year.update', {id: yearSelected.value?.id}), {
            preserveScroll: true,
            onFinish: () => {
                form.reset('status', 'passcode', 'title');
                handleShowDialog(false, '');

                showToast(page?.props?.flash)
            },
        });
    }

    const handleUpdateStatus = (year: AcademicYear) => {
        form.put(route('academic.year.update.status', {id: year.id}), {
            preserveScroll: true,
            onFinish: () => {
                showToast(page?.props?.flash)
            }
        });
    };

    const handleDelete = (year: AcademicYear) => {
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
                router.delete(route('academic.year.destroy', {id: year.id}), {
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
