import { Contact } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    edit: (data: Contact) => void;
    delete: (data: Contact) => void;
};

export const columns = (props: childProps): ColumnDef<Contact>[] => {
    return [
        {
            id: 'name',
            accessorKey: 'name',
            header: 'Nama',
        },
        {
            id: 'email',
            accessorKey: 'email',
            header: 'Email',
        },
        {
            id: 'message',
            accessorKey: 'message',
            header: 'Pesan',
        },
        {
            id: 'id',
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const contact = row.original;

                return h(Actions, {
                    contact,
                    onEdit: () => props.edit(contact),
                    onDelete: () => props.delete(contact),
                });
            },
        },
    ];
};
