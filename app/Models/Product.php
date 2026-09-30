<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'model_name', 'type', 'horsepower', 'brand', 'image', 'description', 'price', 'prefix'];

    public function stock() {
        return $this->hasOne(Stock::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function serials()
    {
        return $this->hasMany(ProductSerial::class);
    }
}
