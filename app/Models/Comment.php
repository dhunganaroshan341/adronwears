<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    use HasFactory;
    protected $fillable=['name','email','content','user_id','commentable_type','commentable_id'];

    // public function post(){
    //     return $this->belongsTo(Post::class,'post_id','id');
    // }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function commentable(){
        return $this->morphTo();
    }
}
