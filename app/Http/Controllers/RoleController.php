<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    public function __construct()
    {
        // Requiere estar autenticado; la comprobación de "admin" se hace dentro.
        $this->middleware('auth');
    }

    /**
     * Mostrar listado de usuarios y roles.
     */
    public function index()
    {
        $this->authorizeAdmin();

        // Obtener usuarios (puedes paginar si hay muchos)
        $usuarios = User::with('roles')->get();

        // Obtener lista de roles disponibles (desde Spatie si está instalado)
        $roles = Role::pluck('name')->toArray();

        return view('admin.roles.index', compact('usuarios', 'roles'));
    }

    /**
     * Actualizar rol del usuario.
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        // Obtener roles válidos (desde la tabla roles)
        $validRoles = Role::pluck('name')->toArray();

        $request->validate([
            'role' => ['required', 'in:' . implode(',', $validRoles)],
        ]);

        $usuario = User::findOrFail($id);
        $newRole = $request->role;

        // Si el modelo usa HasRoles (Spatie), sincronizamos roles
        if (method_exists($usuario, 'syncRoles')) {
            $usuario->syncRoles([$newRole]);
        }

        // Además actualizamos un campo role simple (por compatibilidad)
        if (isset($usuario->role)) {
            $usuario->role = $newRole;
            $usuario->save();
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Método helper para autorizar solo administradores.
     * Comprueba Spatie (hasRole) o el campo role.
     */
    protected function authorizeAdmin()
    {
        $user = auth()->user();

        if (! $user) {
            abort(403, 'No autenticado.');
        }

        // Si el usuario tiene método hasRole (Spatie), usarlo
        if (method_exists($user, 'hasRole')) {
            if ($user->hasRole('administrador')) {
                return true;
            }
        }

        // Si existe campo role lo verificamos
        if (isset($user->role) && $user->role === 'administrador') {
            return true;
        }

        abort(403, 'No tienes permisos para acceder a esta sección.');
    }
}
