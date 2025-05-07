<script setup lang="ts">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { FlexRender, getCoreRowModel, getFilteredRowModel, useVueTable } from '@tanstack/vue-table';
import { ref, watchEffect } from 'vue';

const props = defineProps<{
    columns: any,
    data: any[]
}>()

const dataTable = ref<any>()

watchEffect(() => {
    dataTable.value = useVueTable({
        data: props.data,
        columns: props.columns,
        getCoreRowModel: getCoreRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
        manualPagination: true,
    })
})
</script>

<template>
    <div class="rounded-md border">
        <Table>
            <TableHeader>
                <TableRow
                    v-for="headerGroup in dataTable.getHeaderGroups()"
                    :key="headerGroup.id"
                >
                    <TableHead v-for="header in headerGroup.headers" :key="header.id">
                        <FlexRender
                            v-if="!header.isPlaceholder"
                            :render="header.column.columnDef.header"
                            :props="header.getContext()"
                        />
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <template v-if="dataTable.getRowModel().rows?.length">
                    <template v-for="row in dataTable.getRowModel().rows" :key="row.id">
                        <TableRow>
                            <TableCell v-for="cell in row.getAllCells()" :key="cell.id">
                                <FlexRender
                                    :render="cell.column.columnDef.cell"
                                    :props="cell.getContext()"
                                />
                            </TableCell>
                        </TableRow>
                    </template>
                </template>
                <TableRow v-else>
                    <TableCell :colspan="columns.length" class="h-24 text-center">
                        No results.
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>

<style scoped>

</style>
