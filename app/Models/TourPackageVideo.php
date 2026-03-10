<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackageVideo extends BaseModel
{
    protected $fillable = [
        'tour_package_id',
        'title',
        'iframe_embed_code',
        'iframe',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
