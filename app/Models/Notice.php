<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends BaseModel
{
    use HasFactory;
    protected $fillable=['title','description','image','status','url'];



    public function getImageUrlAttribute(){
        $url = asset ('uploads/'.$this->image);
        return $url;
    }
}
