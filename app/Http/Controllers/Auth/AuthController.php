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
     * Creates a new user with the data received after validating it
     * and returns a message with a status and the data created
     * in JSON format.
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
     * Logs in a user after validating the data received is correct
     * and provides an access token for the user with a expiration
     * date, a message and a status in JSON format.
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
     * Sends the authenticated user data with a message,
     * and a status in JSON format.
     */
    public function profile()
    {
        $user = Auth::user();

        return response() -> json([
            'message' => 'Datos del perfil',
            'status' => true,
            'data' => $user
        ]);
    }

    /**
     * Logs out a user by rescinding it's access token and
     * returns a message with a status in JSON format.
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
