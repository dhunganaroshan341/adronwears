<?php

namespace App\Domain\Order\Services;

use App\Models\ShippingRequest;
use Illuminate\Support\Facades\DB;

class ShippingRequestQueryService
{
    public function filter(array $filters)
    {
        $query = ShippingRequest::query();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('customer_name', 'like', "%{$filters['search']}%")
                    ->orWhere('customer_phone', 'like', "%{$filters['search']}%")
                    ->orWhere('customer_email', 'like', "%{$filters['search']}%");
            });
        }

        return $query->latest()->paginate(15);
    }
}
