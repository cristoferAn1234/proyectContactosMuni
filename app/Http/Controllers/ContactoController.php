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
        try {
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
                'email_institucional' => 'required|email|max:100|unique:contactos,email_institucional',
                'organizacion_id' => 'required|exists:organizaciones,id',
                'activo' => 'required|boolean',
                'nivel_contacto' => 'required|string|max:50',
            ], [
                'email_institucional.unique' => 'El correo institucional ya está registrado en el sistema.',
                'email_institucional.required' => 'El correo institucional es obligatorio.',
                'email_institucional.email' => 'El correo institucional debe ser una dirección válida.',
                'nombre.required' => 'El nombre es obligatorio.',
                'apellido1.required' => 'El primer apellido es obligatorio.',
                'apellido2.required' => 'El segundo apellido es obligatorio.',
                'sexo.required' => 'El sexo es obligatorio.',
                'puesto.required' => 'El puesto es obligatorio.',
                'puesto_id.required' => 'Debe seleccionar un puesto.',
                'puesto_id.exists' => 'El puesto seleccionado no es válido.',
                'departamento.required' => 'El departamento es obligatorio.',
                'formacion.required' => 'La formación académica es obligatoria.',
                'organizacion_id.required' => 'Debe seleccionar una organización.',
                'organizacion_id.exists' => 'La organización seleccionada no es válida.',
                'activo.required' => 'El estado es obligatorio.',
                'nivel_contacto.required' => 'El nivel de contacto es obligatorio.',
            ]);

            // Agregar usuario que crea y actualiza
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();

            $contacto = Contacto::create($validated);

            return redirect()->route('contactos.index')->with('success', 'Contacto creado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el contacto: ' . $e->getMessage())->withInput();
        }
    }

    // Actualizar un contacto
    public function update(Request $request, $id)
    {
        try {
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
            ], [
                'email_institucional.unique' => 'El correo institucional ya está registrado en el sistema.',
                'email_institucional.required' => 'El correo institucional es obligatorio.',
                'email_institucional.email' => 'El correo institucional debe ser una dirección válida.',
                'nombre.required' => 'El nombre es obligatorio.',
                'apellido1.required' => 'El primer apellido es obligatorio.',
                'apellido2.required' => 'El segundo apellido es obligatorio.',
            ]);

            // Actualizar usuario que modifica
            $validated['updated_by'] = auth()->id();

            $contacto->update($validated);

            return redirect()->route('contactos.index')->with('success', 'Contacto actualizado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el contacto: ' . $e->getMessage())->withInput();
        }
    }

    // Eliminar un contacto
    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();

        return redirect()->route('contactos.index')->with('success', 'Contacto eliminado correctamente.');
    }
}
