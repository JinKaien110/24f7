<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSerial extends Model
{

    protected $table = 'product_serials';

    protected $fillable = [
        'product_id', 'serial_number', 'status'
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderSerial()
{
    return $this->hasOne(OrderSerial::class);
}

}
