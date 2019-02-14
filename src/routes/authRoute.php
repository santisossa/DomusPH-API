<?php

use Src\Lib\Auth;
use Src\Lib\Response;
use Src\Validation\AuthValidation;

$app->group('/auth/', function () {

    $this->post('login', function ($req, $res, $args) {
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
                json_encode($this->models->auth->login($parametros["documento"],$parametros["contraseña"]))
            );
    });
});