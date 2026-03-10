<?php

namespace App\Services\DataTable;

use Illuminate\Http\Request;

class CustomDataTableRequest
{
    public function __construct(private Request $request) {}

    public function search(): ?string
    {
        return $this->request->input('search.value');
    }

    public function orderColumn(): string
    {
        $columns = $this->request->input('columns');
        $order = $this->request->input('order')[0];

        return $columns[$order['column']]['data'];
    }

    public function orderDir(): string
    {
        return $this->request->input('order')[0]['dir'];
    }

    public function start(): int
    {
        return (int) $this->request->input('start', 0);
    }

    public function length(): int
    {
        return (int) $this->request->input('length', 10);
    }
}
