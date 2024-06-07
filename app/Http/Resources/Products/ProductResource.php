<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
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
            'prodName' => $this -> prodName,
            'description' => $this -> description,
            'price' => $this -> price,
            'availability' => $this -> availability,
            'prodImg' => asset(Storage::url($this -> prodImg)),
            'catName' => $this -> category -> catName,
            'catColor' => $this -> category -> catColor,
            'catIcon' => asset(Storage::url($this -> category -> catIcon)),
            'allergens' => $this -> allergens -> map(function ($allergen) {
                return [
                    'id' => $allergen -> id,
                    'name' => $allergen -> alrgnName,
                    'color' => $allergen -> alrgnColor,
                    'icon' => asset(Storage::url($allergen -> alrgnIcon)),
                ];
            }),
            'likes' => $this -> usersLike-> count(),
        ];
    }
}
