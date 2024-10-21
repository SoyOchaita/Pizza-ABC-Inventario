<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'imagen']; // Agregamos imagen a los campos asignables en masa

    // Relación de producto con categoría (un producto pertenece a una categoría)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

