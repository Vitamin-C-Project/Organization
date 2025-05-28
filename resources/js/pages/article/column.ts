import NotFoundPng from '@/assets/image/not-found.png';
import Switch from '@/components/Switch.vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Article } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h } from 'vue';
import Actions from './Actions.vue';

type childProps = {
    delete: (data: Article) => void;
    updateStatus: (data: Article) => void;
};

export const columns = (props: childProps): ColumnDef<Article>[] => {
    return [
        {
            id: 'image',
            accessorKey: 'image',
            header: 'Thumbnail',
            cell: ({ row }) => {
                const article = row.original;

                return h(Avatar, [
                    h(AvatarImage, {
                        src: `/storage/${article.image}`,
                        alt: article.title,
                        class: 'block',
                    }),
                    h(
                        AvatarFallback,
                        h('img', {
                            src: NotFoundPng,
                            alt: article.title,
                        }),
                    ),
                ]);
            },
        },
        {
            id: 'title',
            accessorKey: 'title',
            header: 'Judul Artikel',
        },
        {
            id: 'created_by',
            accessorKey: 'created_by',
            header: 'Penulis',
        },
        {
            id: 'status',
            accessorKey: 'status',
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
            id: 'id',
            accessorKey: 'id',
            header: '',
            cell: ({ row }) => {
                const article = row.original;

                return h(Actions, {
                    article,
                    onDelete: () => props.delete(article),
                });
            },
        },
    ];
};
