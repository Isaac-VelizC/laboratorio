<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenFile extends Model
{
    use HasFactory;
    protected $table = 'imagen_files';
    protected $fillable = ['path'];
}
