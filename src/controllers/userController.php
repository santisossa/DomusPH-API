<?php
namespace Src\Controllers;

use Src\Lib\Response,
    Src\Models\UserModel,
    Illuminate\Database\QueryException;

class UserController
{
    private $response;
    private $conection;

    public function __construct($conection) {
        $this->conection = $conection;
        $this->response = new Response();
    }

    public function createTableUsers($schemaName)
    {
            $this->conection::statement("create database {$schemaName['database']}");
    
        return json_encode($this->response->setResponse(true, "Tabla users creada correctamente",null));
    }

    public function getUsers(){
        try {
            $users = UserModel::all()->toJson();
        } catch (QueryException $e) {
            return $e->getMessage();
        }
        return $users;
    }
    
    public function insertUser($data)
    {
        try {
            $data['contraseña'] = password_hash($data['contraseña'], PASSWORD_BCRYPT);
            $users = new UserModel($data);
            $users->save();
        } catch (QueryException $e) {
            return $e->getMessage();
        }
        
        return json_encode($this->response->setResponse(true, "Usuario registrado Correctamente",null));
    }
    
}



