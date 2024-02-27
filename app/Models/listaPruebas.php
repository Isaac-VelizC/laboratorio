<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaPruebas extends Model
{
    use HasFactory;
    protected $table = 'lista_pruebas';

    protected $fillable = [
        'name',
        'description',
        'cost',
        'status',
        'delete_flag'
    ];

    public function values()
    {
        return $this->hasMany(FormTypeValue::class, 'test_id');
    }
}
