<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'tour_package_id',
        'day_number',
        'title',
        'status',
        'order',
        'description',
    ];
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
   public function getItineraryDurationAttribute()
{
    $day = $this->day_number;

    if (!$day) {
        return null;
    }

    return $day . ' ' . ($day == 1 ? 'day' : 'days');
}

}
