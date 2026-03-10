<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends BaseModel
{
    use HasFactory;
    protected $fillable=['image','title','shortdesc','status','link_text','link_url'];
}
