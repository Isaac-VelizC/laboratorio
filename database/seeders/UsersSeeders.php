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
            'password' => bcrypt('AdminPassword'),
            'firstname' => 'Tarea',
            'lastname' => 'Completo',
            'avatar' => 'uploads/avatar-1.png?v=1689027780',
            'type' => 1,
        ]);

        User::create([
            'name' => 'Joel',
            'email' => 'joel@gmail.com',
            'password' => bcrypt('JoelPassword'),
            'firstname' => 'Joel',
            'lastname' => 'Perez',
            'avatar' => 'uploads/avatar-7.png?v=1690989944',
            'type' => 2,
        ]);

        User::create([
            'name' => 'javier',
            'email' => 'javier@gmail.com',
            'password' => bcrypt('javierPassword'),
            'firstname' => 'javier',
            'lastname' => 'Tito',
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
