import { Config } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    edit: (data: Config) => void;
};

export const columns = (props: childProps): ColumnDef<Config>[] => {
    return [
        {
            accessorKey: 'key',
            header: 'Key',
        },
        {
            accessorKey: 'value',
            header: 'Konten',
            cell: ({ row }) => {
                const config = row.original;

                if (config.type == 'text') {
                    return config.value;
                } else {
                    return h(
                        'a',
                        {
                            href: `/storage/${config.value}`,
                            target: '_blank',
                            rel: 'noopener noreferrer',
                            class: 'text-blue-500',
                            children: config.value,
                        },
                        h('span', {}, config.value),
                    );
                }
            },
        },
        {
            accessorKey: 'type',
            header: 'Tipe',
        },
        {
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const config = row.original;

                return h(Actions, {
                    config,
                    onEdit: () => props.edit(config),
                });
            },
        },
    ];
};
