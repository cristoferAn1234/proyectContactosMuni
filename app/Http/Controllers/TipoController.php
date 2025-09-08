<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    // Mostrar todos los tipos
    public function index()
    {
        $tipos = Tipo::all();
        return response()->json($tipos);
    }

    // Mostrar un tipo específico
    public function show($id)
    {
        $tipo = Tipo::findOrFail($id);
        return response()->json($tipo);
    }

    // Crear un nuevo tipo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $tipo = Tipo::create($validated);

        return response()->json($tipo, 201);
    }

    // Actualizar un tipo existente
    public function update(Request $request, $id)
    {
        $tipo = Tipo::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $tipo->update($validated);

        return response()->json($tipo);
    }

    // Eliminar un tipo
    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->delete();

        return response()->json(['message' => 'Tipo eliminado correctamente.']);
    }
}
