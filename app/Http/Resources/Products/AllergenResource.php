<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AllergenResource extends JsonResource
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
            'alrgnName' => $this -> alrgnName,
            'alrgnColor' => $this -> alrgnColor,
            'alrgnIcon' => asset(Storage::url($this -> alrgnIcon)),
        ];
    }
}
