<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreAllergenRequest;
use App\Http\Requests\Products\UpdateAllergenRequest;
use App\Http\Resources\Products\AllergenResource;
use App\Models\Products\Allergen;
use Illuminate\Support\Facades\Storage;

class AllergenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Almacena todos los alérgenos obtenidos de la base de datos.
        $allergens = Allergen::all();
        // Devuelve los alérgenos en formato JSON.
        return AllergenResource::collection($allergens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAllergenRequest $request)
    {
        // Almacena el alérgeno creado con los campos validados.
        $allergen = Allergen::create($request -> validated());
        // Devuelve el alérgeno creado en formato JSON.
        return new AllergenResource($allergen);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Almacena el alérgeno solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $allergen = Allergen::findOrFail($id);
        // Devuelve el alérgeno solicitado en formato JSON.
        return new AllergenResource($allergen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAllergenRequest $request, string $id)
    {
        // Almacena el alérgeno solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $allergen = Allergen::findOrFail($id);
        // Actualiza el alérgeno con los campos validados.
        $allergen -> update($request -> validated());
        
        // Devuelve el alérgeno actualizado en formato JSON.
        return new AllergenResource($allergen);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Almacena el alérgeno solicitado si encuentra la id especificada
        // o da un fallo en caso contrario.
        $allergen = Allergen::findOrFail($id);
        // Elimina el icono del alérgeno.
        Storage::delete($allergen -> alrgnIcon);
        // Elimina el alérgeno.
        $allergen -> delete();

        // Devuelve una respuesta vacía con un código de estado 204.
        return response(null, 204);
    }
}
