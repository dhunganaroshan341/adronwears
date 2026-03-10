<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurCountry extends BaseModel
{
    use HasFactory;
      protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    protected $table = 'our_countries';
    protected $id = 'id';
    public function packages() {
    return $this->hasMany(TourPackage::class);
}
public function tourPackages()
{
    return $this->hasMany(TourPackage::class);
}
public function favouritePackages()
{
    return $this->hasMany(TourPackage::class)->where('favourite_destination', 1)->where('status', 'Active')->latest()->limit(6);
}


}
