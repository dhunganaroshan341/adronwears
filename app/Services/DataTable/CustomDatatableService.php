<?php

namespace App\Services\DataTable;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;

class CustomDatatableService
{
    public function handle(
        Builder $baseQuery,
        CustomDataTableRequest $dt,
        callable $columnsCallback
    ) {
        // Clone for total count (no relations needed)
        $totalQuery = clone $baseQuery;
        $total = $totalQuery->count();

        // Apply search
        if ($search = $dt->search()) {
            $baseQuery->where('name', 'LIKE', "%{$search}%");
        }

        // Clone for filtered count
        $filteredQuery = clone $baseQuery;
        $filtered = $filteredQuery->count();

        // FINAL query (THIS is where eager loading matters)
        $dataQuery = clone $baseQuery;

        $dataQuery
            ->with('parent') // 🔥 critical line
            ->orderBy($dt->orderColumn(), $dt->orderDir())
            ->offset($dt->start())
            ->limit($dt->length());

        return $columnsCallback(
            DataTables::of($dataQuery)
                ->with('recordsTotal', $total)
                ->with('recordsFiltered', $filtered)
        )->make(true);
    }
}
