import { showToast } from '@/lib/utils';
import { Article, BreadcrumbItem, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';

export default function Hook({ article }: { article?: Article }) {
    const page = usePage<SharedData>();
    const breadcrumbIndex: BreadcrumbItem[] = [
        {
            title: 'Dasbor',
            href: '/dashboard',
        },
        {
            title: 'Artikel',
            href: '/dashboard/article',
        },
    ];
    const breadcrumbCreate: BreadcrumbItem[] = [
        {
            title: 'Dasbor',
            href: '/dashboard',
        },
        {
            title: 'Artikel',
            href: '/dashboard/article',
        },
        {
            title: 'Tambah Anggota',
            href: '/dashboard/article/create',
        },
    ];
    const breadcrumbEdit: BreadcrumbItem[] = [
        {
            title: 'Dasbor',
            href: '/dashboard',
        },
        {
            title: 'Artikel',
            href: '/dashboard/article',
        },
        {
            title: 'Edit Anggota',
            href: '',
        },
    ];

    const imageRef = ref<any>(null);
    const form = useForm({
        title: article ? article.title : '',
        content: article ? article.content : '',
        image: null,
    });

    const handleCreate = () => {
        Object.assign(form, {
            image: imageRef.value?.getFiles()[0],
        });

        form.post(route('article.store'), {
            forceFormData: true,
            onSuccess: () => {
                form.reset();

                showToast(page?.props?.flash);
            },
        });
    };

    const handleUpdate = () => {
        if (imageRef.value?.getFiles().length > 0) {
            Object.assign(form, {
                image: imageRef.value?.getFiles()[0],
            });
        }

        form.post(route('article.update', article?.id), {
            forceFormData: true,
            onSuccess: () => {
                form.reset();

                showToast(page?.props?.flash);
            },
        });
    };

    const handleUpdateStatus = (article: Article) => {
        form.put(route('article.update.status', { id: article.id }), {
            preserveScroll: true,
            onFinish: () => {
                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = (article: Article) => {
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
                router.delete(route('article.destroy', { id: article.id }), {
                    onSuccess: () => {
                        showToast(page?.props?.flash);
                    },
                });
            }
        });
    };

    return {
        state: {
            form,
            imageRef,
            breadcrumbIndex,
            breadcrumbCreate,
            breadcrumbEdit,
        },
        handler: {
            handleCreate,
            handleUpdate,
            handleDelete,
            handleUpdateStatus,
        },
    };
}
