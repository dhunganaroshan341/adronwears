<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteData extends BaseModel
{
    use HasFactory;

    protected $table="site_datas";
    protected $fillable=['site_title','site_logo','site_description'];
    public function sheduleTime(){
        return $this->hasMany(SiteData_SheduleTime::class,'site_data_id','id');
    }
}
