<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermisosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Bioquimico']);
        Role::create(['name' => 'Cliente']);
        
        // Crear permisos
        Permission::create(['name' => 'GestionCitas']);
        /*Permission::create(['name' => 'GestionDocente']);
        Permission::create(['name' => 'GestionEstudiante']);
        Permission::create(['name' => 'Informes']);
        Permission::create(['name' => 'GestionCurso']);
        Permission::create(['name' => 'GestionCalendario']);
        Permission::create(['name' => 'GestionRecetas']);
        Permission::create(['name' => 'EvaluacionDocente']);
        Permission::create(['name' => 'ProgramacionCurso']);
        Permission::create(['name' => 'GestionPagos']);*/
        $adminRole = Role::findByName('Admin');
        $adminRole->givePermissionTo([
            'GestionCitas',
        ]);
        // Asignar roles a usuarios
        $userAdmin = User::find(1);
        $userAdmin->assignRole('Admin');
        $userSecretary = User::find(2);
        $userSecretary->assignRole('Bioquimico');
        $userClient = User::find(3);
        $userClient->assignRole('Cliente');
    }
}
