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
            'nombres' => 'Alex',
            'apellido_pa' => 'Pereira',
            'ci' => '9786757',
            'type' => 1,
        ]);

        User::create([
            'name' => '9898786',
            'email' => 'Perez@gmail.com',
            'password' => bcrypt('Perez'),
            'nombres' => 'Mauricio',
            'apellido_pa' => 'Perez',
            'ci' => '9898786',
            'type' => 2,
        ]);

        User::create([
            'name' => '9999999',
            'email' => 'javier@gmail.com',
            'password' => bcrypt('9999999.l'),
            'nombres' => 'Javier',
            'apellido_pa' => 'Tito',
            'ci' => '9999999',
            'type' => 3,
        ]);

        // Elimina el array adicional alrededor de los datos de listaCliente
        listaCliente::create([
            'gender' => 'Masculino',
            'contact' => '56566556',
            'dob' => '1997-06-02',
            'address' => 'Lima',
            'user_id' => 3
        ]);
    }

}
