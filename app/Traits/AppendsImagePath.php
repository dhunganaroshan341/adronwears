<?php

namespace App\Traits;

trait AppendsImagePath
{
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('uploads/' . $this->image_path) : null;
    }
}
