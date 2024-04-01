<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaPruebaCita extends Model
{
    use HasFactory;
    protected $table = 'lista_prueba_citas';

    protected $fillable = [
        'formulario',
        'appointment_id',
        'test_id',
        'pdf',
        'fecha',
        'estado'
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
