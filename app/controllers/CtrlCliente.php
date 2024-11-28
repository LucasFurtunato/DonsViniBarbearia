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
		
		if (!empty($existingCliente)) {
			$result = [
			    'status' => false,
				'message' => 'Email já registrado.'
			];
			$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			echo $json;
			return;
		}
		
		if (empty($senha)) {
		    $result = [
		        'status' => false,
		        'message' => 'Houve algum problema com a senha'
		    ];
		    $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		    echo $json;
		    return;
		}
		
		// Criptografando a senha
		$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
		
		$this->cliente->populate($clienteId, $nome, $email, $senhaHash, $token, $email_verified);
		$result = $this->cliente->save();
		$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function put() {		
		$clienteId = $this->getParameter('clienteId');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$token = $this->getParameter('token');
		$email_verified = $this->getParameter('email_verified');
		
		// Criptografando a senha, caso seja fornecida
		if (!empty($senha)) {
		    $senha = password_hash($senha, PASSWORD_DEFAULT);
		}
		
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