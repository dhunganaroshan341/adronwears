<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select(
            'id',
            'name',
            'product_category_id',
            'price',
            'sale_price',
            'status',
            'description'
        )->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'product_category_id',
            'price',
            'sale_price',
            'status',
            'description',
        ];
    }
}
