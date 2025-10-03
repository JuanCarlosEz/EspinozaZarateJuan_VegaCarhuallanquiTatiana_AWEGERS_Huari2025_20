<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Lista de usuarios con sus roles
    public function index()
    {
        $usuarios = User::with('roles')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    // Cambiar el rol de un usuario
    public function cambiarRol(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        // Quitamos roles anteriores y asignamos el nuevo
        $usuario->syncRoles([$request->rol]);

        return redirect()->back()->with('success', 'Rol actualizado correctamente');
    }
}
