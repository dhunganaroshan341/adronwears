<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    // Specify which fields are mass assignable (important for seeding and mass updates)
    protected $fillable = [
        'title',
        'count',      // or 'value' depending on your DB column name
        'icon_class', // or 'icon' depending on your DB column name
        'description', // if you have this field
    ];

    // If your table has a different name than 'achievements', specify it:
    // protected $table = 'achievements';
}
