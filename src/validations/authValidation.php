<?php
namespace Src\Validation;

use Src\Lib\Response;

class AuthValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'documento';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value == '') {
                $response->errors[$key][] = 'El valor ingresado no es valido';
            }
        }
        
        $key = 'contraseña';
            if(empty($data[$key])){
                $response->errors[$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];
                
                if(strlen($value) < 4) {
                    $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
                }
            }
      
        $response->setResponse(count($response->errors) === 0,"", null);

        return $response;
    }
}