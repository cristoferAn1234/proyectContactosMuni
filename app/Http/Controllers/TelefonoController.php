<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    // Listar todos los teléfonos
    public function index()
    {
        $telefonos = Telefono::with('contacto')->get();
        return response()->json($telefonos);
    }

    // Mostrar un teléfono específico
    public function show($id)
    {
        $telefono = Telefono::with('contacto')->findOrFail($id);
        return response()->json($telefono);
    }

    // Crear un nuevo teléfono
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contacto_id' => 'required|exists:contactos,id',
            'numero' => 'required|string|max:20|unique:telefonos',
            'tipo' => 'required|in:fijo,celular',
        ]);

        $telefono = Telefono::create($validated);

        return response()->json($telefono, 201);
    }

    // Actualizar un teléfono existente
    public function update(Request $request, $id)
    {
        $telefono = Telefono::findOrFail($id);

        $validated = $request->validate([
            'contacto_id' => 'required|exists:contactos,id',
            'numero' => 'required|string|max:20|unique:telefonos,numero,' . $id,
            'tipo' => 'required|in:fijo,celular',
        ]);

        $telefono->update($validated);

        return response()->json($telefono);
    }

    // Eliminar un teléfono
    public function destroy($id)
    {
        $telefono = Telefono::findOrFail($id);
        $telefono->delete();

        return response()->json(['message' => 'Teléfono eliminado correctamente.']);
    }
}
