<?php

namespace App\Http\Controllers\Addresses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // Mostrar todas las direcciones del usuario
    public function index()
    {
        // Obtener todas las direcciones del usuario autenticado o un array vacío si no existen
        $addresses = Auth::user() ? Auth::user()->addresses ?? collect() : collect();

        return view('addresses.index', compact('addresses'));
    }



    // Mostrar formulario de creación
    public function create()
    {
        return view('addresses.add');
    }

    // Almacenar una nueva dirección
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Auth::user()->addresses()->create($request->all());

        return redirect()->route('addresses.index')->with('success', 'Dirección agregada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);
        return view('addresses.edit', compact('address'));
    }

    // Actualizar una dirección existente
    public function update(Request $request, $id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Dirección actualizada correctamente.');
    }

    // Eliminar una dirección
    public function destroy($id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Dirección eliminada correctamente.');
    }
}

