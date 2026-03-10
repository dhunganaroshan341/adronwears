<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductExcelService
{
    public function upsert(array $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                if (empty($row['name']) || empty($row['product_category_id'])) {
                    continue; // skip invalid rows
                }

                Product::updateOrCreate(
                    ['id' => $row['id'] ?? null], // update by ID
                    [
                        'product_category_id' => $row['product_category_id'],
                        'name' => $row['name'],
                        'description' => $row['description'] ?? null,
                        'price' => $row['price'],
                        'sale_price' => $row['sale_price'] ?? null,
                        'status' => $row['status'] ?? 'active',
                    ]
                );
            }
        });
    }
}
