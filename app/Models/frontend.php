<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frontend extends BaseModel
{
    use HasFactory;
    protected $fillable=['about_us_title','about_us_description','about_us_value','about_us_value_description','contact_us_email','contact_us_address','contact_us_number'];
}
