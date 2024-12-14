<?php

namespace app\controllers;
use app\core\ControllerHandler;
use app\core\CodeGenerator;
use app\models\Cliente;

require_once  dirname( __DIR__ , 1).'/config.php';

include 'SendEmail.php';

class CtrlClienteAl extends ControllerHandler {

	private $cliente = null;

	public function __construct(){
		$this->cliente = new Cliente();
		parent::__construct();
	}
	public function put() {
	    $clienteId = $_SESSION["cliente"]["clienteId"];
	    
	    // Obter os dados do cliente para atualização
	    $nome = $this->getParameter('nome');
	    $senha = $this->getParameter('senha');  // Senha para atualizar
	    $token = '0';
	    $email_verified = 1;
	    
	    // Verifica se o cliente existe
	    $existingCliente = $this->cliente->listByField('clienteId', $clienteId);
	    
	    // Criptografando a senha, caso tenha sido informada
	    if (!empty($senha)) {
	        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
	    }
	    
	    // Se o cliente existir, vamos atualizar os dados
	    if (!empty($existingCliente)) {
	        $email = $existingCliente[0]['email'];
	        
	        $this->cliente->populate($clienteId, $nome, $email, $senhaHash, $token, $email_verified); // Não estamos atualizando o token e email_verified
	        $result = $this->cliente->save();
	        
	        if ($result) {
	            $_SESSION["cliente"]["nome"] = $nome;
	            $_SESSION["cliente"]["email"] = $email;
	            
	            $response = [
	                'status' => true,
	                'message' => 'Alteração feita com sucesso'
	            ];
	        } else {
	            $response = [
	                'status' => false,
	                'message' => 'Houve algum erro ao alterar o perfil'
	            ];
	        }
	    } else {
	        $response = [
	            'status' => false,
	            'message' => 'Este cliente não existe'
	        ];
	    }
	    
	    $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	    echo $json;
	}
	


	public function file(){

	}
}

new CtrlClienteAl();
?>