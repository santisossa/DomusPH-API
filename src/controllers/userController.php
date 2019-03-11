<?php
namespace Src\Controllers;

use Src\Lib\Response,
    Src\Models\UserModel,
    Src\Models\NewSchema,
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
        if(!isset($schemaName['database'])){
           return json_encode($this->response->setResponse(false , "Debe ingresar el nombre de la nueva base de datos",null));
        }

        $this->conection::statement("CREATE SCHEMA IF NOT EXISTS {$schemaName['database']}");
        
        $create = new NewSchema($schemaName['database']);
        $create->createNewSchema();
        /* $dbname = $schemaName['database'];
        $result =  $this->conection::statement(
                "SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = '$dbname'");

                var_dump($result);
                exit; */

    



        
        
  
        return json_encode($this->response->setResponse(true, "Tabla users creada correctamente",null)); 
    }

    public function getUsers()
    {
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

            $user = User::where('votes', '>', 100)->firstOrFail();

            $data['contraseña'] = password_hash($data['contraseña'], PASSWORD_BCRYPT);
            $users = new UserModel($data);
            $users->save();
        } catch (QueryException $e) {
            return $e->getMessage();
        }
        
        return json_encode($this->response->setResponse(true, "Usuario registrado Correctamente",null));
    }

    public function getScriptNewDatabase($nameDatabase)
    {
        $scriptSql = "";

        return $scriptSql;
    }
    
}



