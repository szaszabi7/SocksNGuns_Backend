<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function item() {
        return $this->hasMany(Item::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        'item_id',
        'order_id',
        'quantity'
    ];
}
