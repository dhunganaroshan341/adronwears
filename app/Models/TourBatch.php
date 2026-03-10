<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourBatch extends Model
{
    use HasFactory;

    // Optional: define the table if it doesn't follow Laravel's naming convention
    // protected $table = 'tour_batches';

    // ✅ Mass assignable fields
    protected $fillable = [
        'tour_package_id',
        'start_date',
        'end_date',
        'max_people',
        'available_seats',
        'price',
        'status',
    ];
    protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
];


    // ✅ Relationship to TourPackage
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
