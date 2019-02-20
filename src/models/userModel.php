<?php

namespace Src\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "usuarios";
    public $timestamps = false;
    protected $primaryKey = 'documento';
    protected $fillable = [
        'documento',
        'nombre',
        'apellido',
        'correo',
        'contraseña',
        'edad',
        'codRol',
        'codPropiedad'
    ];


    public function userRegister($data)
    {
        $data['contraseña'] = password_hash($data['contraseña'], PASSWORD_BCRYPT);
        $user = $this->table->insert($data);

        return $this->response->setResponse(true, "Usuario registrado Correctamente",null);
    }
}