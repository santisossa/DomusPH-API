<?php

use Src\Validation\AuthValidation,
    Src\Controllers\AuthController;

$app->group('/auth/', function () {

    $this->post('login', function ($req, $res, $args) {
        $login = new AuthController($this->db);
        $parametros = $req->getParsedBody();
        $errores = AuthValidation::validate($parametros);
        if(!$errores->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($errores->errors));            
        }
        return $res
            ->withHeader('Content-type', 'application/json')
            ->write(
                json_encode($login->login($parametros["documento"],$parametros["contraseña"]))
            );
    });
});