<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaCita extends Model
{
    use HasFactory;
    protected $table = 'lista_citas';
    protected $fillable = [
        'hora_id',
        'code',
        'horario',
        'fecha',
        'client_id',
        'prescription',
        'status',
        'user_id'
    ];

    // Relación con el modelo Client
    public function client()
    {
        return $this->belongsTo(listaCliente::class, 'client_id');
    }

    // Relación con el modelo AppointmentTestList
    public function pruebas()
    {
        return $this->hasMany(listaPruebaCita::class, 'appointment_id');
    }

    // Relación con el modelo HistoryList
    public function history()
    {
        return $this->hasOne(listaHistorial::class, 'appointment_id');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
