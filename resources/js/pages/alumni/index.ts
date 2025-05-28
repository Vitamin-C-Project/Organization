import { ALUMNI_TYPES } from '@/constants';
import { showToast } from '@/lib/utils';
import { Alumni, BreadcrumbItem, SharedData } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

export default function Hook() {
    const page = usePage<SharedData>();
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dasbor',
            href: '/dashboard',
        },
        {
            title: 'Alumni',
            href: '/dashboard/alumni',
        },
    ];
    const alumniSelected = ref<Alumni>();
    const showDialog = ref({
        show: false,
        title: '',
        type: 1,
    });

    const form = useForm({
        destination_name: '',
        appointment: '',
        graduation_year: '',
        type: '',
    });

    const handleShowDialog = (show: boolean, title: string, type?: number) => {
        showDialog.value = {
            show: show,
            title: title,
            type: type || 1,
        };
    };

    const handleUpdate = () => {
        form.put(route('alumni.update', { id: alumniSelected.value?.id }), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                handleShowDialog(false, '');

                showToast(page?.props?.flash);
            },
        });
    };

    const handleDelete = () => {};

    const handleEdit = (alumni: Alumni) => {
        alumniSelected.value = alumni;
        handleShowDialog(true, 'Edit Alumni', 2);
        Object.assign(form, {
            destination_name: alumni.destination_name,
            appointment: alumni.appointment,
            graduation_year: alumni.graduation_year,
            type: alumni.type,
        });
    };

    return {
        state: {
            form,
            showDialog,
            breadcrumbs,
            alumniTypes: ALUMNI_TYPES,
        },
        handler: {
            handleEdit,
            handleUpdate,
            handleDelete,
            handleShowDialog,
        },
    };
}
