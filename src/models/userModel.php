<?php

namespace Src\Models;

use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder;
use Src\Lib\Response;

class UserModel
{
    private $logger;
    protected $table;
    private $response;

    public function __construct(LoggerInterface $logger, Builder $table) 
    {
        $this->logger = $logger;
        $this->table = $table;
        $this->response = new Response();
    }

    public function userRegister($data)
    {
        $data['contraseña'] = password_hash($data['contraseña'], PASSWORD_BCRYPT);
        $user = $this->table->insert($data);

        return $this->response->setResponse(true, "Usuario registrado Correctamente",null);
    }

   /*  public  function validateDocument($documento)
    {
        $sqlDocumento = $this->table->where('documento', '=', $documento)->get()->toArray();
        var_dump($sqlDocumento);

        exit();


        return $this->response->setResponse(true, "Usuario registrado Correctamente",null);
    }
 */

}