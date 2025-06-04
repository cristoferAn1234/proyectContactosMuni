<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use Exception;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
     $provincia = Provincia::all();
     return response()->json(($provincia), 200);
        }catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener las provincias: ' . $e->getMessage()], 500);
        }
    }

    
   
    public function store(Request $request)
    {
    $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        try {
            $provincia = Provincia::create($request->all());
            return response()->json($provincia, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear la provincia: ' . $e->getMessage()], 500);
        }  
    }
    // De momento no lo usamos, pero lo dejamos comentado por si lo necesitamos en el futuro
/*
    public function show(string $id)
    {
        try {
            $provincia = Provincia::findOrFail($id);
            return response()->json($provincia, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener la provincia: ' . $e->getMessage()], 500);
        }
    }
*/
 
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        try {
            $provincia = Provincia::findOrFail($id);
            $provincia->update($request->all());
            return response()->json($provincia, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al actualizar la provincia: ' . $e->getMessage()], 500);
        }
    }


    public function destroy(string $id)
    {
        try {
            $provincia = Provincia::findOrFail($id);
            $provincia->delete();
            return response()->json(['message' => 'Provincia eliminada con éxito'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al eliminar la provincia: ' . $e->getMessage()], 500);
        }
    }
}
