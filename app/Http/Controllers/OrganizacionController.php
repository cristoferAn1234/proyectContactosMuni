<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'ced_juridica' => 'required|integer|unique:organizaciones,ced_juridica',
            'nombre' => 'required|string|max:150',
            'tipo_id' => 'required|exists:tiposOrganizacion,id',
            'telefono' => 'required|string|max:150|unique:organizaciones,telefono',
            'correo' => 'required|email|max:200|unique:organizaciones,correo',
            'urlPageWeb' => 'nullable|string|max:200',
            'provincia_id' => 'required|exists:provincias,id',
            'canton_id' => 'required|exists:cantones,id',
            'distrito_id' => 'required|exists:distritos,id',
            'ubi_lat' => 'required|numeric|between:-90,90',
            'ubi_long' => 'required|numeric|between:-180,180',
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
            'ced_juridica' => 'required|integer|unique:organizaciones,ced_juridica,' . Rule::ignore($id),
            'nombre' => 'required|string|max:150',
            'tipo_id' => 'required|exists:tiposOrganizacion,id',
            'telefono' => 'required|string|max:150|unique:organizaciones,telefono,' . Rule::ignore($id),
            'correo' => 'required|email|max:200|unique:organizaciones,correo,' . Rule::ignore($id),
            'urlPageWeb' => 'nullable|string|max:200',
            'provincia_id' => 'required|exists:provincias,id',
            'canton_id' => 'required|exists:cantones,id',
            'distrito_id' => 'required|exists:distritos,id',
            'ubi_lat' => 'nullable|decimal:40,30',
            'ubi_long' => 'nullable|decimal:40,30',
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
