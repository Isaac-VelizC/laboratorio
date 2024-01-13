<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaHistorial extends Model
{
    use HasFactory;
    protected $table = 'lista_historials';

    protected $fillable = [
        'appointment_id',
        'status',
        'remarks',
    ];

    // Relación con el modelo AppointmentList
    public function appointment()
    {
        return $this->belongsTo(listaCita::class, 'appointment_id');
    }
}
