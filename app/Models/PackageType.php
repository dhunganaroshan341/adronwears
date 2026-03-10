<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageType extends BaseModel
{
    use HasFactory;
    protected $table = 'package_types';
    protected $fillable = [
        'title',
        'short_desc',
        'description',
        'status',
    ];
    // You can add relationships here if needed in the future
    // For example, if you want to relate it to TourPackage:
    // public function tourPackages()
    // {
    //     return $this->hasMany(TourPackage::class);
    // }
   public function packages() {
    return $this->hasMany(TourPackage::class);
}
}
