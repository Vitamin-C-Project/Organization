import DocxPng from '@/assets/image/docx.png';
import PdfPng from '@/assets/image/pdf.png';
import PptxPng from '@/assets/image/pptx.png';
import VideoPng from '@/assets/image/video.png';
import XlsxPng from '@/assets/image/xlsx.png';
import { showToast } from '@/lib/utils';
import { Album, BreadcrumbItem, SharedData } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';

export default function Hook({ album }: { album?: Album }) {
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
        {
            title: album?.title!,
            href: `/dashboard/gallery/${album?.slug}`,
        },
    ];
    const filesRef = ref<any>(null);
    const form = useForm({
        files: [] as any,
    });
    const fileSelected = ref('');

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

    const handleSubmit = () => {
        for (let index = 0; index < filesRef.value.getFiles().length; index++) {
            form.files.push(filesRef.value.getFiles()[index]);
        }

        form.post(route('gallery.upload', album?.id), {
            forceFormData: true,
            onSuccess: () => {
                form.reset();
                handleShowDialog(false, '');

                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = (id: string) => {
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
                router.delete(route('gallery.delete.file', { id: id }), {
                    onFinish: () => {
                        showToast(page?.props?.flash);
                    },
                });
            }
        });
    };

    const handleDownload = (id: string) => {
        router.get(
            route('gallery.download.file', { id: id }),
            {},
            {
                onFinish: () => {
                    showToast(page?.props?.flash);
                },
            },
        );
    };

    const convertFile = (file: string) => {
        return file.split(',');
    };

    const renderImage = (type: string, path: string) => {
        if (['xlsx', 'xls'].some((item) => item == type)) {
            return XlsxPng;
        }

        if (type == 'pdf') {
            return PdfPng;
        }

        if (['docx', 'doc'].some((item) => item == type)) {
            return DocxPng;
        }

        if (['pptx', 'ppt'].some((item) => item == type)) {
            return PptxPng;
        }

        if (['mp4', 'mkv', 'mp3'].some((item) => item == type)) {
            return VideoPng;
        }

        return path;
    };

    const renderFile = (type: string, path: string) => {
        const appUrl = import.meta.env.VITE_APP_URL;
        if (['xlsx', 'xls', 'pptx', 'ppt', 'docx', 'doc'].some((item) => item == type)) {
            return `${import.meta.env.VITE_OFFICE_LIVE_URL}${appUrl}${path}`;
        }

        return `${appUrl}${path}`;
    };

    return {
        state: { breadcrumbs, showDialog, form, filesRef, fileSelected },
        handler: { handleShowDialog, handleSubmit, convertFile, renderImage, renderFile, handleDelete, handleDownload },
    };
}
