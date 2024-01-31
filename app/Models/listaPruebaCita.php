<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaPruebaCita extends Model
{
    use HasFactory;
    protected $table = 'lista_prueba_citas';

    protected $fillable = [
        'informe',
        'descripcion',
        'appointment_id',
        'test_id',
    ];

    // Relación con el modelo AppointmentList
    public function appointment()
    {
        return $this->belongsTo(listaCita::class, 'appointment_id');
    }

    // Relación con el modelo TestList
    public function test()
    {
        return $this->belongsTo(listaPruebas::class, 'test_id');
    }
}
