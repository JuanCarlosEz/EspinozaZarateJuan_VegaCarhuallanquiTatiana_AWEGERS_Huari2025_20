<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function __construct()
    {
        // Solo usuarios autenticados pueden entrar
        $this->middleware('auth');
    }

    /**
     * Mostrar listado de usuarios y roles.
     */
    public function index()
    {
        $this->authorizeAdmin();

        // Cargar usuarios con sus roles Spatie
        $usuarios = User::with('roles')->get();

        // Obtener roles desde Spatie (solo los válidos para asignar)
        $roles = Role::pluck('name')->toArray();

        return view('admin.roles.index', compact('usuarios', 'roles'));
    }

    /**
     * Actualizar rol del usuario.
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $usuario = User::findOrFail($id);

        // Determinar su rol actual (Spatie o campo local)
        $rolActual = method_exists($usuario, 'getRoleNames')
            ? $usuario->getRoleNames()->first()
            : ($usuario->role ?? null);

        $rolActualNormalizado = strtolower(trim($rolActual ?? ''));

        // ⚠️ No permitir modificar a un administrador
        if ($rolActualNormalizado === 'administrador') {
            return back()->with('error', 'No puedes modificar el rol de un administrador.');
        }

        // Validar el nuevo rol
        $nuevoRol = strtolower(trim($request->role));

        // Solo se pueden asignar estos dos roles
        $rolesPermitidos = ['ciudadano', 'conductor'];

        if (!in_array($nuevoRol, $rolesPermitidos)) {
            return back()->with('error', 'Rol no permitido.');
        }

        // 🔄 Actualizar rol Spatie (si aplica)
        if (method_exists($usuario, 'syncRoles')) {
            $usuario->syncRoles([$nuevoRol]);
        }

        // 🔄 Actualizar campo role en la BD (si existe)
        if (in_array('role', $usuario->getFillable())) {
            $usuario->role = $nuevoRol;
            $usuario->save();
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Verificar que el usuario actual sea administrador.
     */
    protected function authorizeAdmin()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'No autenticado.');
        }

        // Verificar rol con Spatie
        if (method_exists($user, 'hasRole') && $user->hasRole('administrador')) {
            return true;
        }

        // Verificar campo role directamente
        if (isset($user->role) && strtolower(trim($user->role)) === 'administrador') {
            return true;
        }

        abort(403, 'No tienes permisos para acceder a esta sección.');
    }
}
