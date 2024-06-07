<?php

namespace App\Models\Users;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'streetType',
        'streetName',
        'number',
        'city',
        'postalCode'
    ];

    /**
     * Relación 1:N con User.
     * Una dirección la pueden tener muchos usuarios.
     */
    public function users(): HasMany
    {
        return $this -> hasMany(User::class);
    }
}
