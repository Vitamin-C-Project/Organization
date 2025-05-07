import { ColumnDef } from '@tanstack/vue-table';
import { Grade } from '@/types';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    edit: (data: Grade) => void;
    delete: (data: Grade) => void;
};

export const columns = (props: childProps): ColumnDef<Grade>[] => {
    return [
        {
            id: 'class',
            accessorKey: 'class',
            header: 'Tahun',
        },
        {
            id: 'id',
            accessorKey: 'id',
            header: '',
            cell: ({row}) => {
                const grade = row.original

                return h(
                    Actions,
                    {
                        grade,
                        onEdit: () => props.edit(grade),
                        onDelete: () => props.delete(grade),
                    },
                )
            }
        }
    ]
};
