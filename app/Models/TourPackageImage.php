<?php

namespace App\Models;

use App\Traits\HasUploadUrl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TourPackageImage extends Model
{
    // use HasUploadUrl;
    // // If your column is named 'image_path' (default), no need to set this
    // protected $uploadPathColumn = 'image_path';
    //   protected $appends = ['image_url'];
    protected $fillable = [
        'tour_package_id',
        'image_path',
        'caption',
        'is_featured',
    ];

   public function tourPackage()
{
    return $this->belongsTo(TourPackage::class, 'tour_package_id', 'id');
}
public function getImagePathAttribute($value)
{
    if (!$value) {
        // Fallback image if image_path is null or empty
        return asset('template/yatri_world/main-file/images/india.jpg');
    }

    return Str::startsWith($value, 'uploads/')
        ? asset($value)
        : asset('uploads/' . ltrim($value, '/'));
}
}

