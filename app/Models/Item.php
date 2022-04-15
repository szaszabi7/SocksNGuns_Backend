<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function order_item() {
        return $this->belongsTo(Category::class);
    }

    public function review() {
        return $this->hasMany(Review::class);
    }

    protected $fillable = [
        'name',
        'image',
        'price',
        'quantity',
        'category_id'
    ];
}
