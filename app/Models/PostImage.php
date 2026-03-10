<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostImage extends BaseModel
{
    use HasFactory;
    protected $table="post_images";
    protected $fillable=['post_id','image'];

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }

}
