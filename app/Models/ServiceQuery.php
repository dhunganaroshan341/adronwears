<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceQuery extends BaseModel
{
    use HasFactory;
    protected $table = 'service_queries';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'service_id',
    ];

    /**
     * Get the service that this query belongs to.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
