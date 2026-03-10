<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- add this
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory; // <-- add this

 protected $fillable = [
    'name',
    'position',
    'photo',
    'facebook',
    'twitter',
    'linkedin',
    'instagram',
    'order',
];

// Accessor for full image URL
    public function getImageUrlAttribute()
    {
        if ($this->photo) {
            return asset('uploads/' . $this->photo);
        }
        // fallback default image
        return asset('template/yatri_world/main-file/images/User.png');
    }

}


