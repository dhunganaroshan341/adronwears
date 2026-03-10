<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends BaseModel
{
    protected $fillable = [
        'title',
        'image',
        'rating',
        'button_text',
        'button_link',
        'status', // Assuming you have a status field to manage active/inactive
    ];
}
