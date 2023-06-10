<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
    ];

    // Relaciones
    public function products(): BelongsTo
    {
        //? BELONGS TO INDICA QUE LA OTRA TABLA ES LA PRINCIPAL
        return $this->belongsTo(Product::class);
    }
}
