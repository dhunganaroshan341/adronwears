<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'address_line',
        'city',
        'state',
        'postal_code',
        'country',
        'status',
        'notes',
    ];

    /**
     * Cart that generated this shipping request.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Product being requested for shipping.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Logged-in user who created the request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
