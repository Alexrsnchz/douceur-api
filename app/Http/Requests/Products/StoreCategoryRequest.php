<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'catName' => 'required|string|min:3|unique:categories,catName',
            'catColor' => 'required|string|starts_with:#|size:7',
            'catIcon' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048'
        ];
    }

    /**
     * Envía una respuesta de error en formato JSON 
     * en caso de que la validación falle.
     */
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response() -> json([
            'message' => 'Ha habido un error en la validación',
            'status' => false,
            'data' => $validator -> errors()
        ]));
    }
}
