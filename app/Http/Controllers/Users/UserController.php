<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\Users\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Almacena el usuario creado con los campos validados.
        $user = User::create($request -> validated());
        // Devuelve el resource creado en formato JSON.
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        // Almacena el usuario solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $user = User::findOrFail($id);
        // Actualiza el usuario con los campos validados.
        $user -> update($request -> validated());

        // Devuelve el usuario actualizado en formato JSON.
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Almacena el usuario solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $user = User::findOrFail($id);
        // Elimina el usuario.
        $user -> delete();

        // Devuelve una respuesta vacía con un código de estado 204.
        return response(null, 204);
    }
}
