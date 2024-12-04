<?php

namespace app\controllers;
use app\core\ControllerHandler;
use app\models\Cliente;

require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlClienteVfyPass extends ControllerHandler {

    private $cliente = null;

	public function __construct(){
		$this->cliente = new Cliente();
		parent::__construct();
	}

	public function get() {

	}
	
	public function post() {
	    $email = $_SESSION["cliente"]["email"];
	    $senha = $this->getParameter('senha');
	    
	    // Armazena as informações do cliente
	    $existingCliente = $this->cliente->listByField('email', $email)[0];
	    
	    if (!empty($existingCliente)) {
	        $storedHash = $existingCliente['senha'];
	        
	        if (password_verify($senha, $storedHash)) {
	            $result = [
	                'status' => true,
	                'message' => 'Senha correta'
	            ];
	        } else {
	            $result = [
	                'status' => false,
	                'message' => 'Senha incorreta'
	            ];
	        }
	    } else {
	        $result = [
	            'status' => false,
	            'message' => 'Usuário não existente'
	        ];
	    }
	    
	    // Codifica o resultado em JSON e envia como resposta
	    echo \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	

	public function put() {		

	}

	public function delete() {		

	}

	public function file(){
    
    	}
}

new CtrlClienteVfyPass();
?>