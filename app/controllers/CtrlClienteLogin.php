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
	    
	    // Tentar recuperar o cliente pelo email
	    $existingCliente = $this->cliente->listByField('email', $email);
	    
	    // Verifica se o cliente existe
	    if (!empty($existingCliente) && $email === $existingCliente[0]['email']) {
			$email_verified = $existingCliente[0]['email_verified'];
	    
			if ($email_verified == 0) {
				// Email não verificado
				$result = [
					'status' => false,
					'message' => 'Email não verificado ou a Senha e Email incorretos'
				];
				// Codifica o resultado em JSON e envia como resposta
				echo \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				return;
			}

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
	                'message' => 'Email não verificado ou a Senha e Email incorretos'
	            ];
	        }
	    } else {
	        // Email não encontrado
	        $result = [
	            'status' => false,
	            'message' => 'Email não verificado ou a Senha e Email incorretos'
	        ];
	    }
	    
	    // Codifica o resultado em JSON e envia como resposta
	    echo \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	

	public function put() {		
	    $token = $this->getParameter('token');
	    $senha = $this->getParameter('senha');
	    
	    $existingCliente = $this->cliente->listByField('token', $token);
	    
	    if (!empty($existingCliente)) {
	        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
	        
	        $clienteId = $existingCliente[0]["clienteId"];
	        $nome = $existingCliente[0]["nome"];
	        $email = $existingCliente[0]["email"];
	        $senha = $senhaHash;
	        $token = '0';
	        $email_verified = $existingCliente[0]["email_verified"];
	        
	        $this->cliente->populate( $clienteId, $nome, $email, $senha, $token, $email_verified);
	        $result = $this->cliente->save();
	        
	        if ($result) {
	            $response = [
	                'status' => true,
	                'message' => 'Senha mudada com sucesso'
	            ];
	        } else {
	            $response = [
	                'status' => false,
	                'message' => 'Houve algum erro ao registar a nova senha'
	            ];
	        }
	    } else {
	        $response = [
	            'status' => false,
	            'message' => 'Este token não existe'
	        ];
	    }
	    
	    // Codifica o resultado em JSON e envia como resposta
	    echo \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	public function delete() {		

	}

	public function file(){
    
    	}
}

new CtrlClienteLogin();
?>