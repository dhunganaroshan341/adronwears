<?php

namespace App\Models;

use App\Traits\HasUploadUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    use HasUploadUrl;

    protected $fillable = [
        'product_id',
        'image_path',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
