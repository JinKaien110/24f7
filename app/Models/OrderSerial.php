<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSerial extends Model
{
    protected $fillable = ['order_id', 'product_serial_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productSerial()
    {
        return $this->belongsTo(ProductSerial::class);
    }
}
