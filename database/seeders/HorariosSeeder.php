<?php

namespace Database\Seeders;

use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define la hora de inicio y fin
        $horaInicio = Carbon::parse('08:30:00');
        $horaFin = Carbon::parse('20:00:00');

        // Itera sobre cada hora desde la hora de inicio hasta la hora de fin
        while ($horaInicio <= $horaFin) {
            // Crea un nuevo horario en la base de datos
            Horario::create([
                'hora' => $horaInicio->format('H:i:s'),
            ]);

            // Añade 30 minutos para el siguiente horario
            $horaInicio->addMinutes(30);
        }
    }
}
