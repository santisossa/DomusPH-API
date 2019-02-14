<?php
namespace Src\Lib;

class Response
{
	public $token = null;
	public $response = false;
	public $message = 'Ocurrio un error inesperado.';
	public $errors = [];
	public $user = null;

	public function setResponse($response, $m = '', $user)
	{
		$this->response = $response;

		$this->message = $m;
		$this->user = (object)$user[0];
		

		if (!$response && $m = '') $this->response = 'Ocurrio un error inesperado';

		return $this;
	}
}