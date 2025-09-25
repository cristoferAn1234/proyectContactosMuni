<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\TipoOrganizacion;
use Illuminate\Http\Request;

class TipoOrganizacionController extends Controller
{
    // Mostrar todos los tipos
    public function index()
    {
        $tipos = TipoOrganizacion::all();
        return response()->json($tipos);
    }

    // Mostrar un tipo específico
    public function show($id)
    {
        $tipo = TipoOrganizacion::findOrFail($id);
        return response()->json($tipo);
    }

    // Crear un nuevo tipo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $tipo = TipoOrganizacion::create($validated);

        return response()->json($tipo, 201);
    }

    // Actualizar un tipo existente
    public function update(Request $request, $id)
    {
        $tipo = TipoOrganizacion::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $tipo->update($validated);

        return response()->json($tipo);
    }

    // Eliminar un tipo
    public function destroy($id)
    {
        $tipo = TipoOrganizacion::findOrFail($id);
        $tipo->delete();

        return response()->json(['message' => 'Tipo eliminado correctamente.']);
    }
}
