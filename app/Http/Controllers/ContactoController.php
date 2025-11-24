<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    // Obtener todos los contactos
    public function index(Request $request)
    {
        $contactos = Contacto::with(['organizacion', 'createdBy', 'updatedBy', 'telefonos'])->get();
        
        // Si la petición es AJAX o espera JSON, retornar JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($contactos);
        }
        
        // Cargar datos necesarios para el modal de crear
        $organizaciones = \App\Models\Organizacion::all();
        $puestos = \App\Models\Puesto::all();
        
        // Si no, retornar la vista Blade con los datos necesarios
        return view('contactos.index', compact('contactos', 'organizaciones', 'puestos'));
    }

    // Mostrar un contacto específico
    public function show(Request $request, $id)
    {
        $contacto = Contacto::with(['organizacion', 'createdBy', 'updatedBy', 'telefonos'])->findOrFail($id);
        
        // Si la petición es AJAX o espera JSON, retornar JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($contacto);
        }
        
        // Si no, retornar la vista Blade
        return view('contactos.show', ['contacto' => $contacto]);
    }

    // Mostrar formulario para crear contacto
    public function create()
    {
        // Cargar datos necesarios para el formulario
        $organizaciones = \App\Models\Organizacion::all();
        $puestos = \App\Models\Puesto::all();
        
        return view('contactos.create', compact('organizaciones', 'puestos'));
    }

    // Mostrar formulario para editar contacto
    public function edit($id)
    {
        $contacto = Contacto::with(['organizacion', 'telefonos'])->findOrFail($id);
        $organizaciones = \App\Models\Organizacion::all();
        $puestos = \App\Models\Puesto::all();
        
        return view('contactos.edit', compact('contacto', 'organizaciones', 'puestos'));
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
        ]);

        // Agregar usuario que crea y actualiza
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $contacto = Contacto::create($validated);

        return redirect()->route('contactos.index')->with('success', 'Contacto creado exitosamente.');
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
            'organizacion_id' => 'required|exists:organizaciones,id',
            'activo' => 'required|boolean',
            'nivel_contacto' => 'required|string|max:50',
        ]);

        // Actualizar usuario que modifica
        $validated['updated_by'] = auth()->id();

        $contacto->update($validated);

        return redirect()->route('contactos.index')->with('success', 'Contacto actualizado exitosamente.');
    }

    // Eliminar un contacto
    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();

        return redirect()->route('contactos.index')->with('success', 'Contacto eliminado correctamente.');
    }
}
