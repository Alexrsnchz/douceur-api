<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'catName',
        'catColor',
        'catIcon'
    ];

    /**
     * Relación 1:N con Product.
     * Una categoría puede tener muchos productos.
     */
    public function products(): HasMany
    {
        return $this -> hasMany(Product::class);
    }

    /**
     * Transforma el nombre de la categoría en minúscula
     * y convierte la primera letra en mayúscula.
     */
    protected function catName(): Attribute
    {
        return Attribute::make(
            set: fn($v) => ucfirst(strtolower($v))
        );
    }
}
