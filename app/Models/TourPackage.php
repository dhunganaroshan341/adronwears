<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
 use Illuminate\Database\Eloquent\Casts\Attribute;

class TourPackage extends BaseModel
{
    use HasFactory;
//     protected $casts = [
//     'images' => 'array',
// ];

 protected $casts = [
        'top_deal' => 'boolean',
        'favourite_destination' => 'boolean',
    ];
     protected $fillable = [
        'our_country_id',
        'service_id',
        'parent_id',
        'type',
        'location',
        // 'images',
        // 'title',
        'title',
        'drop',
        'accomodation',
        'pickup',
        'price',
        'price_includes',
        'price_excludes',
        'slug',
        'short_description',
        'package_type',
        'long_description',
        'what_to_expect',
        'itinerary',
        'duration',
        'languages',
        'difficulty',
        'max_elevation',
        'best_season',
        'top_deal',
        'favourite_destination',
        'start_point',
        'end_point',
        'status',
        'max_people',
        'available_seat',
        'is_featured',
    ];



public function location(): Attribute
{
    return Attribute::make(
        set: function ($value) {
            // If location is empty and there is a related country
            if (empty($value) && $this->ourCountry) {
                return $this->ourCountry->name; // Assumes a relation exists
            }
            return $value;
        }
    );
}

    public static function generateSlug($title, $id = null)
{
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $count = 1;

    while (self::where('slug', $slug)->when($id, fn($query) => $query->where('id', '!=', $id))->exists()) {
        $slug = $originalSlug . '-' . $count++;
    }

    return $slug;
}
    public function country() {
    return $this->belongsTo(OurCountry::class,'our_country_id');
}

public function itineraries() {
    return $this->hasMany(Itinerary::class);
}public function priceIncludes() {
    return $this->hasMany(PriceInclude::class);
}

public function images()
{
    return $this->hasMany(TourPackageImage::class, 'tour_package_id', 'id');
}public function packageImages()
{
    return $this->hasMany(TourPackageImage::class, 'tour_package_id', 'id');
}


public function videos() {
    return $this->hasMany(TourPackageVideo::class);
}

public function faqs() {
    return $this->hasMany(TourFaq::class);
}

public function testimonials() {
    return $this->hasMany(Testimonial::class);
}
public function services() {
    return $this->hasMany(TourPackageService::class);
}public function batches() {
    return $this->hasMany(TourBatch::class);
}public function bookings() {
    return $this->hasMany(PackageBooking::class);
}

public function packageType(){
    return $this->belongsTo(PackageType::class, 'package_type_id');
}
public function getDurationAttribute($value)
{
    $number = (int) $value; // cast string to integer
    return $number . ' ' . Str::plural('day', $number);
}
// public function getFirstImageAttribute(){
// }    TourPackage->
public function parent()
{
    return $this->belongsTo(TourPackage::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(TourPackage::class, 'parent_id');
}


public function getFirstImageUrlAttribute()
{
    $firstImage = $this->packageImages->first();

    if ($firstImage && $firstImage->image_path) {
        // image_path accessor in TourPackageImage returns full URL already
        return $firstImage->image_path;
    }

    // fallback static image URL
    return asset('template/yatri_world/main-file/images/india.jpg');
}
protected static function booted()
{
    static::addGlobalScope('orderByItinerariesAndPrice', function ($query) {
        $query->withCount('itineraries')
            ->orderByRaw('(itineraries_count > 0) DESC')   // first those with itineraries
            ->orderBy('itineraries_count', 'desc')        // then by count desc
            ->orderByRaw('(price IS NOT NULL) DESC')       // then those with price
            ->orderBy('price', 'asc');                      // finally by price ascending (or desc)
    });
}


}
