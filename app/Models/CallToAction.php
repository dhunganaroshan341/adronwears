<?php

namespace App\Models;

use App\Traits\HasUploadUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallToAction extends BaseModel
{
    use HasFactory, HasUploadUrl;

    protected $table = 'call_to_actions';
    protected $primaryKey = "id";

    // Specify which column contains the image path
    protected $uploadPathColumn = 'image';

    protected $fillable = [
        'title',
        'page',
        'sub_heading',
        'description',
        'image',
        'link',
        'iframe',
    ];
}
