<?php
namespace Src\Validation;

use Src\Lib\Response,
Src\Models\UserModel;

class UserValidation {

    public function __construct() 
    {
    }
    public  function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'documento';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            $documentoExiste = $this->models->users->validateDocument($value);
            
            if($documentoExiste) {
                $response->errors[$key][] = 'ya existe este documento';
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

        $key = 'contraseña';
            if(empty($data[$key])){
                $response->errors[$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];
                
                if(strlen($value) < 4) {
                    $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
                }
            }
      
        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}