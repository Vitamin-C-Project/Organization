import { Alumni } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    delete: (data: Alumni) => void;
    edit: (data: Alumni) => void;
};

export const columns = (props: childProps): ColumnDef<Alumni>[] => {
    return [
        {
            accessorKey: 'member.name',
            header: 'Nama Alumni',
        },
        {
            accessorKey: 'membership.position.title',
            header: 'Jabatan Terakhir',
            cell: ({ row }) => {
                const alumni = row.original;

                return alumni.membership && alumni.membership.position ? alumni.membership.position.title : '-';
            },
        },
        {
            accessorKey: 'graduation_year',
            header: 'Tahun Lulus',
        },
        {
            accessorKey: 'destination_name',
            header: 'Kegiatan Terakhir',
            cell: ({ row }) => {
                const alumni = row.original;

                return alumni.destination_name && alumni.appointment ? `${alumni.destination_name} - ${alumni.appointment}` : '-';
            },
        },
        {
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const alumni = row.original;

                return h(Actions, {
                    alumni,
                    onDelete: () => props.delete(alumni),
                    onEdit: () => props.edit(alumni),
                });
            },
        },
    ];
};
