<?php

namespace App\Models\Products;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodName',
        'description',
        'price',
        'availability',
        'prodImg',
        'category_id'
    ];

    /**
     * Relación N:M con Allergen.
     * Un producto puede tener muchos alérgenos.
     */
    public function allergens(): BelongsToMany
    {
        return $this -> belongsToMany(Allergen::class);
    }

    /**
     * Relación 1:N con Category.
     * Un producto puede tener una sola categoría.
     */
    public function category(): BelongsTo
    {
        return $this -> belongsTo(Category::class);
    }

    /**
     * Relación N:M con User.
     * Un producto puede tener likes de muchos usuarios.
     */
    public function usersLike(): BelongsToMany
    {
        return $this -> belongsToMany(User::class);
    }

    /**
     * Transforma el nombre del producto en minúscula
     * y convierte la primera letra en mayúscula.
     */
    protected function prodName(): Attribute
    {
        return Attribute::make(
            set: fn($v) => ucfirst(strtolower($v))
        );
    }

    /**
     * Transforma la descripción del producto en minúscula
     * y convierte la primera letra en mayúscula.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn($v) => ucfirst(strtolower($v))
        );
    }
}
