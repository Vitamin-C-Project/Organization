import { Member, Membership } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    edit: (data: Membership) => void;
    delete: (data: Membership) => void;
    transfer: (data: Membership) => void;
};

export const columns = (props: childProps): ColumnDef<Member>[] => {
    return [
        {
            accessorKey: 'name',
            header: 'Nama Anggota',
        },
        {
            accessorKey: 'membership.position.title',
            header: 'Jabatan',
        },
        {
            accessorKey: 'membership.year.title',
            header: 'Tahun Ajaran',
        },
        {
            accessorKey: 'grade.class',
            header: 'Kelas',
        },
        {
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const member = row.original.membership;

                return h(Actions, {
                    member: member!,
                    onEdit: () => props.edit(member!),
                    onDelete: () => props.delete(member!),
                    onTransfer: () => props.transfer(member!),
                });
            },
        },
    ];
};
