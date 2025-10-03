<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'ciudadano']);
        Role::firstOrCreate(['name' => 'conductor']);
        Role::firstOrCreate(['name' => 'administrador']);

        $adminEmail = 'admin@example.com';
        if (!User::where('email', $adminEmail)->exists()) {
            $admin = User::create([
                'nombres' => 'Admin',
                'apellido_paterno' => 'Sistema',
                'apellido_materno' => 'Admin',
                'dni' => '00000000',
                'telefono' => null,
                'email' => $adminEmail,
                'password' => Hash::make('Admin12345'),
            ]);
            $admin->assignRole('administrador');
        }
    }
}
