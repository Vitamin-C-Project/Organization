import { ColumnDef } from '@tanstack/vue-table';
import { Position } from '@/types';
import { h } from 'vue';
import Switch from '@/components/Switch.vue';
import Actions from '@/pages/position/Actions.vue';

type childProps = {
    updateStatus: (data: Position) => void;
    edit: (data: Position) => void;
    delete: (data: Position) => void;
};

export const columns = (props: childProps): ColumnDef<Position>[] => {
    return [
        {
            id: 'title',
            accessorKey: 'title',
            header: 'Jabatan',
        },
        {
            id: 'description',
            accessorKey: 'description',
            header: 'Deskripsi',
        },
        {
            id: 'status',
            accessorKey: 'Status',
            header: 'Status',
            cell: ({row}) => {
                const status = row.original.status
                return h(
                    Switch,
                    {
                        defaultValue: status,
                        onClick: () => {
                            props.updateStatus(row.original);
                        },
                    },
                );
            }
        },
        {
            id: 'id',
            accessorKey: 'id',
            header: '',
            cell: ({row}) => {
                const position = row.original

                return h(
                    Actions,
                    {
                        position,
                        onEdit: () => props.edit(position),
                        onDelete: () => props.delete(position),
                    },
                )
            }
        }
    ]
};
