<?php
namespace Src\Validation;

use Src\Lib\Response;

class AuthValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'documento';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } 
        
        $key = 'contraseña';
            if(empty($data[$key])){
                $response->errors[$key][] = 'Este campo es obligatorio';
            } 
      
        $response->setResponse(count($response->errors) === 0,"", null);

        return $response;
    }
}