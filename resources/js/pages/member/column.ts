import { GENDER } from '@/constants';
import { Member } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    delete: (data: Member) => void;
};

export const columns = (props: childProps): ColumnDef<Member>[] => {
    return [
        {
            accessorKey: 'name',
            header: 'Nama Anggota',
        },
        {
            accessorKey: 'year.title',
            header: 'Tahun Ajaran',
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
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const member = row.original;

                return h(Actions, {
                    member,
                    onDelete: () => props.delete(member),
                });
            },
        },
    ];
};
