<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'transaction_id',
        'product_id',  // Add product_id to fillable
        'quantity', 
        'price',
        'subtotal', 
        'serial_number_id', 
        'status',
        'created_at',
        'updated_at',
        'refund_status',
        'action_reason',
    ];

    public function user() {
    return $this->belongsTo(User::class)->withTrashed(); 
    }
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function serials()
{
    return $this->hasMany(OrderSerial::class);
}

    
}
