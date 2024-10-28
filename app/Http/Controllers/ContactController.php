<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class ContactController extends Controller
{
    // Mostrar el formulario de contacto
    public function create()
    {
        return view('contacto.create');
    }

    // Procesar el envío del formulario de contacto
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Enviar el correo electrónico al encargado de ventas
        Mail::to('ochaita2404@gmail.com')->send(new ContactoMail($request->all()));

        return redirect()->route('dashboard')->with('success', 'Tu mensaje ha sido enviado con éxito. Te estaremos respondiendo por correo.');
    }

}
