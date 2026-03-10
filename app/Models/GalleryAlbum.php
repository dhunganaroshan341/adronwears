<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryAlbum extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'slug',
        'client_id',
        'thumbnail',
        'url',
        'status',
    ];

    /**
     * Relationship: A Gallery Album has many Media items.
     */
    public function galleryMedia()
    {
        return $this->hasMany(GalleryMedia::class, 'gallery_album_id', 'id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    /**
     * Optional: if you want enum casting (Laravel 10+)
     */
    // protected $casts = [
    //     'type' => GalleryTypeEnum::class,
    //     'status' => AlbumStatusEnum::class,
    // ];
    public function getThumbnailAttribute()
{
    $media = $this->galleryMedia()->first();

    if ($media && $media->media_path) {
       return $media->media_path;
    }

    return asset('template/yatri_world/main-file/images/everest.jpg'); // fallback image
}

protected static function booted()
{
    static::creating(function ($album) {
        $album->slug = Str::slug($album->title);
    });

    static::updating(function ($album) {
        $album->slug = Str::slug($album->title);
    });
}


}
