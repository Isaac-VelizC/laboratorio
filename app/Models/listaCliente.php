<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaCliente extends Model
{
    use HasFactory;
    protected $table = 'lista_clientes';

    protected $fillable = [
        'gender',
        'contact',
        'dob',
        'address',
        'estado',
        'user_id'
    ];

    public function appointments()
    {
        return $this->hasMany(listaCita::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
