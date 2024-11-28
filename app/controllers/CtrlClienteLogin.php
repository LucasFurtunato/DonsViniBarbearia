<?php

namespace app\controllers;
use app\core\ControllerHandler;
use app\models\Cliente;

require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlClienteLogin extends ControllerHandler {

    private $cliente = null;

	public function __construct(){
		$this->cliente = new Cliente();
		parent::__construct();
	}

	public function get() {

	}
	
	public function post() {
	    
	    $email = $this->getParameter('email');
	    $senha = $this->getParameter('senha');
	    //$email_verified = 0; usar depois para verificar se o email está verifcado
	    
	    // Tentar recuperar o cliente pelo email
	    $existingCliente = $this->cliente->listByField('email', $email);
	    
	    // Verifica se o cliente existe
	    if (!empty($existingCliente)) {
	        $clienteId = $existingCliente[0]["clienteId"];
	        $nome = $existingCliente[0]["nome"];
	        $storedHash = $existingCliente[0]['senha'];
	        
	        // Verifica se a senha fornecida corresponde à armazenada
	        if (password_verify($senha, $storedHash)) {
	            // Inicia a sessão com os dados do cliente
	            $_SESSION["cliente"]["clienteId"] = $clienteId;
	            $_SESSION["cliente"]["nome"] = $nome;
	            $_SESSION["cliente"]["email"] = $email;
	            
	            // Prepara o resultado de sucesso
	            $result = [
	                'status' => true,
	                'message' => 'Login Executado'
	            ];
	        } else {
	            // Senha incorreta
	            $result = [
	                'status' => false,
	                'message' => 'Senha incorreta'
	            ];
	        }
	    } else {
	        // Email não encontrado
	        $result = [
	            'status' => false,
	            'message' => 'Email não cadastrado'
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

new CtrlClienteLogin();
?>