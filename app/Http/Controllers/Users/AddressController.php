<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreAddressRequest;
use App\Http\Requests\Users\UpdateAddressRequest;
use App\Http\Resources\Users\AddressResource;
use App\Models\Users\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Almacena todas las direcciones obtenidas de la base de datos.
        $addresses = Address::all();
        // Devuelve las direcciones en formato JSON.
        return AddressResource::collection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        // Almacena la dirección creada con los campos validados.
        $address = Address::create($request -> validated());
        // Devuelve la dirección creada en formato JSON.
        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Almacena la dirección solicitada si encuentra la id especificada
        // o da un fallo en caso contrario.
        $address = Address::findOrFail($id);
        // Devuelve la dirección solicitada en formato JSON.
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, string $id)
    {
        // Almacena la dirección solicitada si encuentra la id especificada
        // o da un fallo en caso contrario.
        $address = Address::findOrFail($id);
        // Actualiza la dirección con los campos validados.
        $address -> update($request -> validated());
        
        // Devuelve la dirección actualizada en formato JSON.
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Almacena la dirección solicitada si encuentra la id especificada
        // o da un fallo en caso contrario.
        $address = Address::findOrFail($id);
        // Elimina la dirección.
        $address -> delete();

        // Devuelve una respuesta vacía con un código de estado 204.
        return response(null, 204);
    }
}
