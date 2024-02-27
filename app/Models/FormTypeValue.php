<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormTypeValue extends Model
{
    use HasFactory;
    protected $table = 'form_type_values';

    protected $fillable = [
        'test_id',
        'name',
        'type',
    ];
    // Relación con el modelo Client
    public function prueba()
    {
        return $this->belongsTo(listaPruebas::class, 'test_id');
    }
}
