<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBooking extends Model
{
use HasFactory, SoftDeletes;

    protected $fillable = [
        // Existing
        'user_id',
        'email',
        'name',
        'phone',
        'country',
        'message',
        'children',
        'adult',
        'total_people',
        'price',
        'tour_package_id',
        'tour_batch_id',
        'custom_date',
        'booking_type',
        'status',

        // New fields
        'special_requests',
        'payment_status',
        'amount_paid',
        'currency',
        'trip_start_date',
        'trip_end_date',
        'is_archived',
        'booking_reference',
        'ip_address',
        'user_agent',
        'confirmed_at',
        'cancelled_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function tourBatch()
    {
        return $this->belongsTo(TourBatch::class);
    }
}

