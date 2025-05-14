import Switch from '@/components/Switch.vue';
import { GENDER } from '@/constants';
import { Member } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    delete: (data: Member) => void;
    updateStatus: (data: Member) => void;
};

export const columns = (props: childProps): ColumnDef<Member>[] => {
    return [
        {
            accessorKey: 'name',
            header: 'Nama Anggota',
        },
        {
            accessorKey: 'grade.class',
            header: 'Kelas',
        },
        {
            accessorKey: 'gender',
            header: 'Jenis Kelamin',
            cell: ({ row }) => {
                const gender = row.original.gender;
                return GENDER.find((item) => item.key === gender)?.value;
            },
        },
        {
            accessorKey: 'phone',
            header: 'No WA/Telepon',
        },
        {
            id: 'status',
            accessorKey: 'Status',
            header: 'Status',
            cell: ({ row }) => {
                const status = row.original.status;
                return h(Switch, {
                    defaultValue: status,
                    onClick: () => {
                        props.updateStatus(row.original);
                    },
                });
            },
        },
        {
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const grade = row.original;

                return h(Actions, {
                    grade,
                    onDelete: () => props.delete(grade),
                });
            },
        },
    ];
};
