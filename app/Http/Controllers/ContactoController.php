<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    // Obtener todos los contactos
    public function index()
    {
        $contactos = Contacto::with(['organizacion', 'createdBy', 'updatedBy', 'telefonos'])->get();
        return response()->json($contactos);
    }

    // Mostrar un contacto específico
    public function show($id)
    {
        $contacto = Contacto::with(['organizacion', 'createdBy', 'updatedBy', 'telefonos'])->findOrFail($id);
        return response()->json($contacto);
    }

    // Crear un nuevo contacto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido1' => 'required|string|max:150',
            'apellido2' => 'required|string|max:150',
            'sexo' => 'required|string|max:10',
            'puesto' => 'required|string|max:100',
            'puesto_id' => 'required|exists:puestos,id',
            'departamento' => 'required|string|max:100',
            'formacion' => 'required|string|max:100',
            'extension' => 'nullable|string|max:100',
            'email_institucional' => 'required|email|max:100|unique:contactos',
            'organizacion_id' => 'required|exists:organizaciones,id',
            'activo' => 'required|boolean',
            'nivel_contacto' => 'required|string|max:50',
            'created_by' => 'required|exists:users,id',
            'updated_by' => 'required|exists:users,id',
        ]);

        $contacto = Contacto::create($validated);

        return response()->json($contacto, 201);
    }

    // Actualizar un contacto
    public function update(Request $request, $id)
    {
        $contacto = Contacto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido1' => 'required|string|max:150',
            'apellido2' => 'required|string|max:150',
            'sexo' => 'required|string|max:10',
            'puesto' => 'required|string|max:100',
            'puesto_id' => 'required|exists:puestos,id',
            'departamento' => 'required|string|max:100',
            'formacion' => 'required|string|max:100',
            'extension' => 'nullable|string|max:100',
            'email_institucional' => 'required|email|max:100|unique:contactos,email_institucional,' . $id,
            'email_personal' => 'nullable|email|max:100',
            'organizacion_id' => 'required|exists:organizaciones,id',
            'activo' => 'required|boolean',
            'nivel_contacto' => 'required|string|max:50',
            'created_by' => 'required|exists:users,id',
            'updated_by' => 'required|exists:users,id',
        ]);

        $contacto->update($validated);

        return response()->json($contacto);
    }

    // Eliminar un contacto
    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();

        return response()->json(['message' => 'Contacto eliminado correctamente.']);
    }
}
