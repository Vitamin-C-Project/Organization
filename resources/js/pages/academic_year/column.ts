import { ColumnDef } from '@tanstack/vue-table';
import { AcademicYear } from '@/types';
import { h } from 'vue';
import Switch from '@/components/Switch.vue';
import { Button } from '@/components/ui/button';
import Actions from '@/pages/academic_year/Actions.vue';

type childProps = {
    updateStatus: (data: AcademicYear) => void;
    edit: (data: AcademicYear) => void;
    delete: (data: AcademicYear) => void;
};

export const columns = (props: childProps): ColumnDef<AcademicYear>[] => {
    return [
        {
            id: 'title',
            accessorKey: 'title',
            header: 'Tahun',
        },
        {
            id: 'passcode',
            accessorKey: 'passcode',
            header: 'Passcode',
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
                const year = row.original

                return h(
                    Actions,
                    {
                        year,
                        onEdit: () => props.edit(year),
                        onDelete: () => props.delete(year),
                    },
                )
            }
        }
    ]
};
