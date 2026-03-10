<?php

namespace App\Imports;

use App\Services\ProductExcelService;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToArray, WithHeadingRow
{
    protected ProductExcelService $service;

    public function __construct(ProductExcelService $service)
    {
        $this->service = $service;
    }

    public function array(array $rows)
    {
        $this->service->upsert($rows);
    }
}
