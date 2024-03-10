<?php

namespace Database\Seeders;

use App\Models\listaCliente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'nombres' => 'Tarea',
            'apellido_pa' => 'Completo',
            'ci' => '9786757',
            'avatar' => 'uploads/avatar-1.png?v=1689027780',
            'type' => 1,
        ]);

        User::create([
            'name' => 'Mauricio Perez',
            'email' => 'Perez@gmail.com',
            'password' => bcrypt('Perez'),
            'nombres' => 'Perez',
            'apellido_pa' => 'Perez',
            'ci' => '9898786',
            'avatar' => 'uploads/avatar-7.png?v=1690989944',
            'type' => 2,
        ]);

        User::create([
            'name' => 'javier',
            'email' => 'javier@gmail.com',
            'password' => bcrypt('javier'),
            'nombres' => 'Javier',
            'apellido_pa' => 'Tito',
            'ci' => '86756544',
            'avatar' => 'uploads/client-6.png?v=1690995142',
            'type' => 3,
        ]);

        // Elimina el array adicional alrededor de los datos de listaCliente
        listaCliente::create([
            'gender' => 'Masculino',
            'contact' => '565665566',
            'dob' => '1997-06-02',
            'address' => 'Lima',
            'user_id' => 3
        ]);
    }

}
