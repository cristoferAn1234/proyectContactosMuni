<?php

namespace App\Http\Controllers;

use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizacionController extends Controller
{
    // Mostrar todas las organizaciones
    public function index(Request $request)
    {
        $organizaciones = Organizacion::with(['tipo', 'provincia', 'canton', 'distrito', 'user'])->get();
        
        // Si la petición es AJAX o espera JSON, retornar JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($organizaciones);
        }
        
        // Cargar datos necesarios para el modal de crear
        $tipos = \App\Models\TipoOrganizacion::all();
        $provincias = \App\Models\Provincia::all();
        $cantones = \App\Models\Canton::all();
        $distritos = \App\Models\Distrito::all();
        
        // Si no, retornar la vista Blade
        return view('organizaciones.index', compact('organizaciones', 'tipos', 'provincias', 'cantones', 'distritos'));

    }

    // Mostrar una organización específica
    public function show(Request $request, $id)
    {
        $organizacion = Organizacion::with(['tipo', 'provincia', 'canton', 'distrito', 'user'])->findOrFail($id);
        
        // Si la petición es AJAX o espera JSON, retornar JSON
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json($organizacion);
        }
        
        // Si no, retornar la vista Blade
        return view('organizaciones.show', ['organizacion' => $organizacion]);
    }

    // Mostrar formulario para crear organización
    public function create()
    {
        $tipos = \App\Models\TipoOrganizacion::all();
        $provincias = \App\Models\Provincia::all();
        $cantones = \App\Models\Canton::all();
        $distritos = \App\Models\Distrito::all();
        
        return view('organizaciones.create', compact('tipos', 'provincias', 'cantones', 'distritos'));
    }

    // Mostrar formulario para editar organización
    public function edit($id)
    {
        $organizacion = Organizacion::with(['tipo', 'provincia', 'canton', 'distrito'])->findOrFail($id);
        $tipos = \App\Models\TipoOrganizacion::all();
        $provincias = \App\Models\Provincia::all();
        $cantones = \App\Models\Canton::all();
        $distritos = \App\Models\Distrito::all();
        
        return view('organizaciones.edit', compact('organizacion', 'tipos', 'provincias', 'cantones', 'distritos'));
    }

    // Crear una nueva organización
    public function store(Request $request)
    {
        try {
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
                'ubi_lat' => 'nullable|string|max:100',
                'ubi_long' => 'nullable|string|max:100',
                'urlDirectorioTelefonico' => 'nullable|string|max:200',
            ], [
                'ced_juridica.required' => 'La cédula jurídica es obligatoria.',
                'ced_juridica.integer' => 'La cédula jurídica debe ser un número.',
                'ced_juridica.unique' => 'Esta cédula jurídica ya está registrada en el sistema.',
                'nombre.required' => 'El nombre de la organización es obligatorio.',
                'tipo_id.required' => 'Debe seleccionar un tipo de organización.',
                'tipo_id.exists' => 'El tipo de organización seleccionado no es válido.',
                'telefono.required' => 'El teléfono es obligatorio.',
                'telefono.unique' => 'Este teléfono ya está registrado en el sistema.',
                'correo.required' => 'El correo electrónico es obligatorio.',
                'correo.email' => 'El correo electrónico debe ser una dirección válida.',
                'correo.unique' => 'Este correo electrónico ya está registrado en el sistema.',
                'provincia_id.required' => 'Debe seleccionar una provincia.',
                'canton_id.required' => 'Debe seleccionar un cantón.',
                'distrito_id.required' => 'Debe seleccionar un distrito.',
            ]);

            // Agregar usuario que crea
            $validated['user_id'] = auth()->id();

            $organizacion = Organizacion::create($validated);

            return redirect()->route('organizaciones.index')->with('success', 'Organización creada exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la organización: ' . $e->getMessage())->withInput();
        }
    }

    // Actualizar una organización existente
    public function update(Request $request, $id)
    {
        try {
            $organizacion = Organizacion::findOrFail($id);

            $validated = $request->validate([
                'ced_juridica' => 'required|integer|unique:organizaciones,ced_juridica,' . $id,
                'nombre' => 'required|string|max:150',
                'tipo_id' => 'required|exists:tiposOrganizacion,id',
                'telefono' => 'required|string|max:150|unique:organizaciones,telefono,' . $id,
                'correo' => 'required|email|max:200|unique:organizaciones,correo,' . $id,
                'urlPageWeb' => 'nullable|string|max:200',
                'provincia_id' => 'required|exists:provincias,id',
                'canton_id' => 'required|exists:cantones,id',
                'distrito_id' => 'required|exists:distritos,id',
                'ubi_lat' => 'nullable|string|max:100',
                'ubi_long' => 'nullable|string|max:100',
                'urlDirectorioTelefonico' => 'nullable|string|max:200',
            ], [
                'ced_juridica.unique' => 'Esta cédula jurídica ya está registrada en el sistema.',
                'telefono.unique' => 'Este teléfono ya está registrado en el sistema.',
                'correo.unique' => 'Este correo electrónico ya está registrado en el sistema.',
                'correo.email' => 'El correo electrónico debe ser una dirección válida.',
            ]);

            $organizacion->update($validated);

            return redirect()->route('organizaciones.index')->with('success', 'Organización actualizada exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la organización: ' . $e->getMessage())->withInput();
        }
    }

    // Eliminar una organización
    public function destroy($id)
    {
        $organizacion = Organizacion::findOrFail($id);
        $organizacion->delete();

        return redirect()->route('organizaciones.index')->with('success', 'Organización eliminada correctamente.');
    }

    public function disponibles()
    {
        return Organizacion::whereNull('user_id')->with('tipo:id,nombre')->get();
    }

    public function desasignarUsuario($id, $userId)
    {
        $organizacion = Organizacion::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $organizacion->user_id = null;
        $organizacion->save();

        return response()->json(['message' => 'Usuario desasignado de la organización', 'organizacion' => $organizacion]);
    }
    public function assignarUsuario(Request $request)
    {
        $validated = $request->validate([
            'organizacion_id' => 'required|exists:organizaciones,id',
            'user_id' => 'required|exists:users,id',
        ]);             

        $organizacion = Organizacion::findOrFail($validated['organizacion_id']);
        $organizacion->user_id = $validated['user_id'];
        $organizacion->save();

        return response()->json(['message' => 'Usuario asignado a la organización']);
    }
    public function asignaciones($id)
    {
        return Organizacion::where('user_id', $id)->with('tipo:id,nombre')->get();
    }
}