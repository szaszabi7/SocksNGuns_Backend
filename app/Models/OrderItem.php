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
        return $this->hasMany(Item::class);
    }

    protected $fillable = [
        'item_id'
    ];
}
