<?php

namespace Src\Controllers;

use Src\Lib\Response,
    Src\Models\UserModel,
    Src\Lib\Auth,
    Illuminate\Database\QueryException;

class AuthController
{
    private $response;
    private $conection;

    public function __construct($conection) {
        $this->conection = $conection;
        $this->response = new Response();
    }
    
    public function login($documento, $password)
    {
        $user = UserModel::where('documento', '=', $documento)->first();
        if (empty($user)) {
            return $this->response->setResponse(false, "Credenciales incorrectas", null);
        } else {
            if (password_verify($password, $user->contraseña)) {
                $token = Auth::SignIn([
                    "Documento" => $user->documento,
                    "Nombre" => $user->nombre,
                    "Apellido" => $user->apellido,
                    "Correo" => $user->correo,
                ]);
                $this->response->token = $token;
                unset($user->contraseña);
                return $this->response->setResponse(true, "", $user);
            } else
                return $this->response->setResponse(false, "Credenciales incorrectas", null);
        }
    }
}