<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'name', 'description', 'category_id', 'stock', 'image', 'slug', 'price'
    ];

    // Relaciones
    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}
