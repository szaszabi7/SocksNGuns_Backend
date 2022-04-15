<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasMany(User::class);
    }

    public function order_item() {
        return $this->belongsTo(OrderItem::class);
    }

    protected $fillable = [
        'status',
        'user_id',
        'total_price'
    ];
}
