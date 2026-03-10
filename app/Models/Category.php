<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends BaseModel
{
    use HasFactory;
    protected $fillable=['title','status','slug'];
     protected static $slugSource = 'title'; // slug will be generated from "name"

public function posts()
{
    return $this->belongsToMany(Post::class, 'category_posts', 'category_id', 'post_id');
}

 // Auto-generate slug when creating



}
