<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseModel
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = ['image','name', 'short_desc','description', 'status','price'];

    public function queries()
{
    return $this->hasMany(ServiceQuery::class);
}

  // 🔁 Optional: Backward relation
    public function tourPackageServices()
    {
        return $this->hasMany(TourPackageService::class);
    }


}
