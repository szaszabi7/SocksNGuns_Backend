<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function review() {
        return $this->hasMany(Review::class);
    }

    public function cartItem() {
        return $this->hasMany(CartItem::class);
    }

    protected $fillable = [
        'name',
        'image',
        'price',
        'quantity',
        'category_id'
    ];
}
