<?php

namespace App\Http\Resources\Users;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this -> id,
            'title' => $this -> title,
            'content' => $this -> content,
            'state' => $this -> state,
            'postImg' => asset(Storage::url($this -> postImg)),
            'user_id' => $this -> user -> username,
            'created_at' => $this -> created_at -> locale('es_ES') -> isoFormat('DD/MM/YYYY'),
            'updated_at' => $this -> updated_at -> locale('es_ES') -> isoFormat('DD/MM/YYYY')
        ];
    }
}
