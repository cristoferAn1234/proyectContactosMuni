<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canton;
use Exception;

class CantonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
 try {
            $cantones = Canton::all();
            return response()->json($cantones, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener los cantones: ' . $e->getMessage()], 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'provincia_id' => 'required|exists:provincias,id',
        ]);

        try {
            $canton = Canton::create($request->all());
            return response()->json($canton, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear el cantón: ' . $e->getMessage()], 500);
        }
    }

  

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $canton = Canton::findOrFail($id);
            return response()->json($canton, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener el cantón: ' . $e->getMessage()], 500);
        }
    }

    
}
