<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryMedia extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'gallery_album_id',
        'media_path',
        'status',
        'url'
    ];
protected array $imageFields = ['media_path', 'thumbnail', 'banner'];

    /**
     * Relationship: Media item belongs to a Gallery Album.
     */
    public function galleryAlbum()
{
    return $this->belongsTo(GalleryAlbum::class);
}


    /**
     * Optional: Enum casting (if using enums for status)
     */
    // protected $casts = [
    //     'status' => MediaStatusEnum::class,
    // ];
    // lets make an accessor that returns the media_path with gallery/media


   public function getImageAttribute()
{
    if ($this->media_path) {
return $this->media_path;    }

    // Fallback if media_path is null or empty
    return asset('template/yatri_world/main-file/images/india.jpg');
}

}
