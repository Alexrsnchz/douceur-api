<?php

namespace App\Models\Users;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'isAdmin',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relación N:M con Product.
     * Un usuario puede dar like a muchos productos.
     */
    public function productsLike(): BelongsToMany
    {
        return $this -> belongsToMany(Product::class);
    }

    /**
     * Relación 1:N con Post.
     * Un usuario puede tener muchos posts.
     */
    public function posts(): HasMany
    {
        return $this -> hasMany(Post::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * 
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this -> getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * 
     * @return array;
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Transforms the password of a registered user
     * into a hash.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }
}
