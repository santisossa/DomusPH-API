<?php

namespace Src\Models;

use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder;
use Src\Lib\Auth;
use Src\Lib\Response;

class AuthModel
{
    private $logger;
    protected $table;
    private $response;

    public function __construct(
        LoggerInterface $logger,
        Builder $table

    ) {
        $this->logger = $logger;
        $this->table = $table;
        $this->response = new Response();
    }

    public function login($documento, $password)
    {

        $user = $this->table
            ->where('documento', '=', $documento)
            ->get()->toArray();

        if (is_array($user) && !empty($user)) {
            if (password_verify($password, $user[0]->contraseña)) {
                $token = Auth::SignIn([
                    "Documento" => $user[0]->documento,
                    "Nombre" => $user[0]->nombre,
                    "Apellido" => $user[0]->apellido,
                    "Correo" => $user[0]->correo,
                ]);
                $this->response->token = $token;
                unset($user[0]->contraseña);
                return $this->response->setResponse(true, "", $user);
            } else
                return $this->response->setResponse(false, "Credenciales incorrectas", null);
        } else
            return $this->response->setResponse(false, "Credenciales incorrectas", null);
    }
}