<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Mail\ContactMailable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request -> validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:5000',
        ]);

        try {
            Mail::to('pasteleriadouceur@gmail.com') 
            -> send(new ContactMailable(
                ucwords($request -> name),
                ucwords($request -> lastName), 
                $request -> email, 
                ucfirst($request -> content)
            ));
        } catch(Exception $e) {
            return response() -> json([
                'message' => 'No se ha podido enviar el correo',
                'status' => false,
                'error' => $e -> getMessage(),
            ], 400);
        }

        return response() -> json([
            'message' => 'Correo enviado con éxito',
            'status' => true,
        ], 200);
    }
}
