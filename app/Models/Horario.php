<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horarios';
    protected $fillable = [
        'hora',
        'fecha',
        'estado',
    ];

    // Relación con el modelo AppointmentTestList
    public function citas()
    {
        return $this->hasMany(listaCita::class, 'hora_id');
    }
}
