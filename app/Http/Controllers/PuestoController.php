<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puesto;
use Exception;
class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
            $puestos = Puesto::all();
            return response()->json($puestos, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener los puestos: ' . $e->getMessage()], 500);
        }
    }

 
    public function store(Request $request)
    {
        try {
            $puesto = Puesto::create($request->all());
            return response()->json($puesto, 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al crear el puesto: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $puesto = Puesto::findOrFail($id);
            return response()->json($puesto, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al obtener el puesto: ' . $e->getMessage()], 500);
        }
    }
        //
    }

 

