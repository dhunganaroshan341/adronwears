<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteData_SheduleTime extends BaseModel
{
    use HasFactory;
    protected $fillable=['site_data_id','starting_day','ending_day','starting_time','ending_time'];

    public function sheduleTime(){
        return $this->belongsTo(SiteData_SheduleTime::class);
    }
}
