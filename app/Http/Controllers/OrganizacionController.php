<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Illuminate\Http\Request;

class OrganizacionController extends Controller
{
    // Mostrar todas las organizaciones
    public function index()
    {
        $organizaciones = Organizacion::with(['tipo', 'provincia', 'user'])->get();
        return response()->json($organizaciones);
    }

    // Mostrar una organización específica
    public function show($id)
    {
        $organizacion = Organizacion::with(['tipo', 'provincia', 'user'])->findOrFail($id);
        return response()->json($organizacion);
    }

    // Crear una nueva organización
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ced_juridica' => 'required|numeric|unique:organizaciones',
            'nombre' => 'required|string|max:150',
            'tipo_id' => 'required|exists:tipos,id',
            'telefono' => 'required|string|max:150|unique:organizaciones',
            'correo' => 'required|email|max:200|unique:organizaciones',
            'urlPageWeb' => 'nullable|string|max:200',
            'provincia_id' => 'required|exists:provincias,id',
            'ubi_Lat' => 'nullable|string|max:40',
            'ubi_long' => 'nullable|string|max:40',
            'urlDirectorioTelefonico' => 'nullable|string|max:200',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $organizacion = Organizacion::create($validated);

        return response()->json($organizacion, 201);
    }

    // Actualizar una organización existente
    public function update(Request $request, $id)
    {
        $organizacion = Organizacion::findOrFail($id);

        $validated = $request->validate([
            'ced_juridica' => 'required|numeric|unique:organizaciones,ced_juridica,' . $id,
            'nombre' => 'required|string|max:150',
            'tipo_id' => 'required|exists:tipos,id',
            'telefono' => 'required|string|max:150|unique:organizaciones,telefono,' . $id,
            'correo' => 'required|email|max:200|unique:organizaciones,correo,' . $id,
            'urlPageWeb' => 'nullable|string|max:200',
            'provincia_id' => 'required|exists:provincias,id',
            'ubi_Lat' => 'nullable|string|max:40',
            'ubi_long' => 'nullable|string|max:40',
            'urlDirectorioTelefonico' => 'nullable|string|max:200',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $organizacion->update($validated);

        return response()->json($organizacion);
    }

    // Eliminar una organización
    public function destroy($id)
    {
        $organizacion = Organizacion::findOrFail($id);
        $organizacion->delete();

        return response()->json(['message' => 'Organización eliminada']);
    }
}
