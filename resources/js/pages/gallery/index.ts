import { showToast } from '@/lib/utils';
import { Album, BreadcrumbItem, SharedData } from '@/types';
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
            title: 'Galeri',
            href: '/dashboard/gallery',
        },
    ];

    const albumSelected = ref<Album>();

    const form = useForm({
        title: '',
        status: false,
    });

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

    const handleCreate = () => {
        form.post(route('gallery.store'), {
            onSuccess: () => {
                form.reset();
                handleShowDialog(false, '');

                showToast(page?.props?.flash);
            },
        });
        console.log(page?.props);
    };

    const handleEdit = (album: Album) => {
        albumSelected.value = album;
        handleShowDialog(true, 'Edit Album', 2);
        Object.assign(form, {
            title: album.title,
            status: album.status,
        });
    };

    const handleUpdate = () => {
        form.put(route('gallery.update', { id: albumSelected.value?.id }), {
            preserveScroll: true,
            onFinish: () => {
                form.reset();
                handleShowDialog(false, '');

                showToast(page?.props?.flash);
            },
        });
    };

    const handleUpdateStatus = (album: Album) => {
        form.put(route('gallery.update.status', { id: album.id }), {
            preserveScroll: true,
            onFinish: () => {
                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = (album: Album) => {
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
                router.delete(route('gallery.destroy', { id: album.id }), {
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
        state: { breadcrumbs, form, showDialog },
        handler: { handleShowDialog, handleSubmit, handleEdit, handleUpdateStatus, handleDelete },
    };
}
