<?php

namespace app\controllers;
use app\core\CodeGenerator;
use app\core\ControllerHandler;
use app\models\Cliente;

require_once  dirname( __DIR__ , 1).'/config.php';

include 'SendEmail.php';

class CtrlClienteVfyEmail extends ControllerHandler {

    private $cliente = null;

	public function __construct(){
		$this->cliente = new Cliente();
		parent::__construct();
	}

	public function get() {

	}
	
	public function post() {

	}

	public function put() {		
	    $email = $this->getParameter('email');
	    
	    $existingCliente = $this->cliente->listByField('email', $email);
	    
	    if (!empty($existingCliente)) {
	        $email_verified = $existingCliente[0]['email_verified'];
	        
	        if ($email_verified == 1) {
	            $clienteId = $existingCliente[0]["clienteId"];
	            $nome = $existingCliente[0]["nome"];
	            $senha = $existingCliente[0]["senha"];
	            $token = (new CodeGenerator())->run(5);
	            
	            $this->cliente->populate( $clienteId, $nome, $email, $senha, $token, $email_verified);
	            $result = $this->cliente->save();
	            
	            if ($result) {
	                $emailResult = enviarCodRecuperacaoSenha($email, $nome, $token);
	                
	                if ($emailResult['status']) {
	                    $response = [
	                        'status' => true,
	                        'message' => 'Enviamos um token para o email indicado'
	                    ];
	                } else {
	                    $response = [
	                        'status' => false,
	                        'message' => 'Houve um erro ao enviar o e-mail: ' . $emailResult['message']
	                    ];
	                }
	            } else {
	                $response = [
	                    'status' => false,
	                    'message' => 'Houve algum ao gerar o token'
	                ];
	            }
	        } else {
	            $response = [
	                'status' => false,
	                'message' => 'Este email não foi verificado ainda'
	            ];
	        }
	    } else {
	        $response = [
	            'status' => false,
	            'message' => 'Este endereço de email não está registrado'
	        ];
	    }
	    
	    $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	    echo $json;
	}

	public function delete() {		

	}

	public function file(){
    
    	}
}

new CtrlClienteVfyEmail();
?>