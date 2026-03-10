<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackageService extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id',
        'service_id',
        'title',
        'description',
        'status',
        'price',
    ];

    // 🔁 Relationship with TourPackage
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

    // 🔁 Relationship with Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
