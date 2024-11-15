<?php

namespace app\controllers;
use app\core\ControllerHandler;
use app\core\CodeGenerator;
use app\models\Cliente;

require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlCliente extends ControllerHandler {

	private $cliente = null;

	public function __construct(){
		$this->cliente = new Cliente();
		parent::__construct();
	}

	public function get() {
		$this->cliente = new Cliente();
		$data = $this->cliente->listAll();
		$json = \json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {        
		$clienteId = 0;
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$token = (new CodeGenerator())->run(10);
		$email_verified = 0;
		
		$existingCliente = $this->cliente->listByField('email', $email);
		
		if (!empty($nome)) {
			if (!empty($existingCliente)) {
				$result = [
					'status' => 'error',
					'message' => 'Email já registrado.'
				];
				$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				echo $json;
				return;
			}
			
			$this->cliente->populate($clienteId, $nome, $email, $senha, $token, $email_verified);
			$result = $this->cliente->save();
			$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			echo $json;
		} else if (!empty($existingCliente)) {
			$validationUser = $this->cliente->checkUserExists($email, $senha);
			if (!empty($validationUser)){
			    $cliente = $validationUser[0];
			    $nome = $cliente['nome'];
			    
        		$_SESSION["cliente"] = $nome;
        		
				$result = [
					'status' => 'true',
					'message' => 'Login Executado'
				];
				$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				echo $json;
			} else {
				$result = [
					'status' => 'error',
					'message' => 'Cliente não registrado.'
				];
				$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				echo $json;
			}
		}
	}

	public function put() {		
		$clienteId = $this->getParameter('clienteId');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$token = $this->getParameter('token');
		$email_verified = $this->getParameter('email_verified');
	    $this->cliente->populate( $clienteId, $nome, $email, $senha, $token, $email_verified);
		$result = $this->cliente->save();
		echo $result;
	}

	public function delete() {		
		$clienteId = $this->getParameter('clienteId');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$token = $this->getParameter('token');
		$email_verified = $this->getParameter('email_verified');
	    $this->cliente->populate( $clienteId, $nome, $email, $senha, $token, $email_verified);
		$result = $this->cliente->delete();
		echo $result;
	}

	public function file(){

	}
}

new CtrlCliente();
?>