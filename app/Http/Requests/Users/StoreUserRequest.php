<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|min:5|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'isAdmin' => 'required|boolean',
            'address' => 'nullable|string|min:5'
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
