<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'state',
        'postImg',
        'user_id'
    ];

    /**
     * Relación 1:N con User.
     * Un post puede tener un solo usuario.
     */
    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }
}
