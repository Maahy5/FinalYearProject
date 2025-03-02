<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable =
    [
        'name',
        'image',
        'description',
        'long_description',
        'price',
        'slug'
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
