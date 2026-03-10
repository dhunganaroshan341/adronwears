<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedService extends BaseModel
{
    use HasFactory;
    protected $table = 'featured_services';
    protected $fillable = ['service_id', 'sort_order'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
