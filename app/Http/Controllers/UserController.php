<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
// Registro de usuario
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email', // Validación de email único
        'password' => 'required|string|min:6'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => 'user', // Asignación del rol
        'aprobado' => 'pendiente', // Por defecto, el usuario no está aprobado
        'password' => Hash::make($request->password) // Contraseña encriptada
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
        'message' => 'Usuario registrado correctamente',
        'role' => $user->role, // Incluye el rol en la respuesta
        'aprobado' => $user->aprobado // Incluye el estado de aprobación en la respuesta
    ], 201);
}

// Inicio de sesión
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Las credenciales son incorrectas.']
        ]);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
        'message' => 'Inicio de sesión exitoso'
    ], 200);
}

// Cerrar sesión
public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
}

public function getUser()
{
    $users = User::select('id', 'name')->get();

    if ($users->isEmpty()) {
        return response()->json(['message' => 'No se encontraron usuarios.'], 404);
    }

    return response()->json($users, 200);
}
public function asignRole(Request $request, $id,$idadmin)
{
    // Verificar si el usuario autenticado es un administrador
    $admin = User::findOrFail($idadmin);
    if ($admin->role !== 'admin') {
        return response()->json(['message' => 'No tienes permiso para asignar roles'], 403);
    }

    $request->validate([
        'role' => 'required|in:admin,user', // Validación del rol
        'aprobado' => 'required|boolean', // Validación del campo aprobado
    ]);

    $user = User::findOrFail($id);
    $user->role = $request->role;
    $user->save();

    return response()->json(['message' => 'Rol asignado correctamente'], 200);
}

public function getUsersPendingApproval(Request $request)
{
    $status = $request->input('status', 'all');

    $query = User::query();

    if ($status !== 'all') {
        switch ($status) {
            case 'pendiente':
                $query->where('aprobado', 'pendiente');
                break;
            case 'aprobado':
                $query->where('aprobado', 'aprobado');
                break;
            case 'no_aprobado':
                $query->where('aprobado', 'no_aprobado');
                break;
            default:
                return response()->json(['message' => 'Filtro inválido'], 400);
        }
    }

    $users = $query->select('id', 'name', 'email', 'aprobado', 'role')->get();

    // Return view (Blade expects HTML from the select form)
    return view('userTcu.solicitudes', ['users' => $users]);
}

/**
 * Aprobar un usuario
 */
public function approveUser($id)
{
    $user = User::findOrFail($id);
    $user->aprobado = 'aprobado';
    $user->save();

    return redirect()->back()->with('success', 'Usuario aprobado correctamente.');
}

/**
 * Rechazar un usuario
 */
public function rejectUser($id)
{
    $user = User::findOrFail($id);
    $user->aprobado = 'no_aprobado';
    $user->save();

    return redirect()->back()->with('success', 'Usuario rechazado.');
}

}