<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = "producto";
    protected $primaryKey = 'id';
    protected $fillable = [
        'Nombre',
        'Precio',
        'Imagen'
    ];


}