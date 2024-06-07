<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StorePostRequest;
use App\Http\Requests\Users\UpdatePostRequest;
use App\Http\Resources\Users\PostResource;
use App\Models\Users\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Almacena todos los posts obtenidos de la base de datos.
        $posts = Post::all();
        // Devuelve los usuarios en formato JSON.
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Almacena el post creado con los campos validados.
        $post = Post::create($request -> validated());
        // Devuelve el post creado en formato JSON.
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Almacena el post solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $post = Post::findOrFail($id);
        // Devuelve el post solicitado en formato JSON.
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        // Almacena el post solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $post = Post::findOrFail($id);
        // Actualiza el usuario con los campos validados.
        $post -> update($request -> validated());

        // Devuelve el post actualizado en formato JSON.
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Almacena el post solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $post = Post::findOrFail($id);
        // Elimina la imagen del post.
        Storage::delete($post -> postImg);
        // Elimina el post.
        $post -> delete();

        // Devuelve una respuesta vacía con un código de estado 204.
        return response(null, 204);
    }
}
