<?php

namespace App\Models;

use App\Traits\HasUploadUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends BaseModel
{
    use HasFactory;
    //  use HasUploadUrl;
    // // If your column is named 'image_path' (default), no need to set this
    // protected $uploadPathColumn = 'image';
    // protected $appends = ['image_url'];
protected array $imageFields = ['image', 'thumbnail', 'banner'];

    protected $fillable=['name','email','address','contact','image','description','type'];
    public function albums()
    {
        return $this->hasMany(GalleryAlbum::class);
    }
public function getImageUrlAttribute()
{
    if ($this->image) {
        // Check if image starts with http or https
        if (preg_match('/^https?:\/\//', $this->image)) {
            return $this->image; // full URL, return as-is
        }

        // Otherwise, prepend uploads path (handle trailing slash)
        return $this->image;
    }

    // fallback image
    return asset('template/yatri_world/main-file/images/clients/logo-01.png');
}




}
