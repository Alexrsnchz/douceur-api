<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergen extends Model
{
    use HasFactory;

    protected $fillable = [
        'alrgnName',
        'alrgnColor',
        'alrgnIcon'
    ];

    /**
     * Relación N:M con Product.
     * Un alérgeno puede estar en muchos productos.
     */
    public function products(): BelongsToMany
    {
        return $this -> belongsToMany(Product::class);
    }

    /**
     * Transforma el nombre del alérgeno en minúscula
     * y convierte la primera letra en mayúscula.
     */
    protected function AlrgnName(): Attribute
    {
        return Attribute::make(
            set: fn($v) => ucfirst(strtolower($v))
        );
    }
}
