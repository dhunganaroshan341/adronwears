<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends BaseModel
{
    use HasFactory;
    protected $table="working_days";
    protected $fillable=['days','starting_time','ending_time','setting_id'];

    public function setting(){
        return $this->belongsTo(Setting::class);
    }
}
