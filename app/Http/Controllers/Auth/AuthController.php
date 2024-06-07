<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Crea un nuevo usuario con los datos recibidos después
     * de validarlos y devuelve un mensaje con un estado y
     * los datos creados en formato JSON.
     */
    public function register(RegisterUserRequest $request)
    {
        $data = $request -> validated();
        
        $user = User::create($data);

        $token = JWTAuth::fromUser($user);
        $expires_in = auth('api') -> factory() -> getTTL() * 60;

        return response() -> json([
            'message' => 'Usuario registrado correctamente',
            'status' => true,
            'data' => $user,
            'token' => $token,
            'expires_in' => $expires_in
        ], 201);
    }

    /**
     * Inicia sesión con el usuario después de validar que las
     * credenciales recibidas son correctas, y otorga un token
     * para dicho usuario con un tiempo de expiración de 1h,
     * un mensaje, y un estado en formato JSON.
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request -> validated();

        if (!$token = JWTAuth::attempt($credentials)) {
            return response() -> json([
                'message' => 'Credenciales inválidas',
                'status' => false
            ], 401);
        }

        $user = Auth::user();
        $expires_in = auth('api') -> factory() -> getTTL() * 60;

        return response() -> json([
            'message' => 'Sesión iniciada correctamente',
            'status' => true,
            'data' => $user,
            'token' => $token,
            'expires_in' => $expires_in
        ]);
    }

    /**
     * Cierra la sesión del usuario invalidando el token
     * de acceso y devuelve un mensaje con un estado
     * en formato JSON.
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response() -> json([
            'message' => 'Se ha cerrado la sesión correctamente',
            'status' => true,
        ]);
    }
}
