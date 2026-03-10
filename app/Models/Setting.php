<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends BaseModel
{
    use HasFactory;
   protected $fillable = [
        'logo',
        'title',
        'email',
        'email2',
        'contact',
        'contact2',          // secondary contact for second office
        'address',
        'address2',          // second office address
        'phone1',            // Nepal office mobile 1
        'phone2',            // Nepal office mobile 2
        'phone3',            // India office mobile 1
        'phone4',            // India office mobile 2
        'landline1',         // Nepal office landline
        'landline2',         // India office landline
        'description',
        'work_description',
        'office_hours',
        'facebook_url',
        'twitter_url',
        'github_url',
        'instagram_url',
        'welcome_image',
        'about_image'
    ];
     public function getLogoUrlAttributes(){
        return 'uploads/'.$this->logo;
    }
    public function getLogoAttribute()
{
    return '/uploads/' . $this->attributes['logo'];
}

}
