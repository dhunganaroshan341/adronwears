<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceInclude extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id',
        'title',
        'price',
        'is_included',
        'description',
    ];

    /**
     * Relationship: Each PriceInclude belongs to one TourPackage.
     */
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
