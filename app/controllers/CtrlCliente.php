<?php

namespace app\controllers;
use app\core\ControllerHandler;
use app\core\CodeGenerator;
use app\models\Cliente;

require_once  dirname( __DIR__ , 1).'/config.php';

include 'SendEmail.php';

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
		    $response = [
			    'status' => false,
				'message' => 'Email já registrado.'
			];
			$json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			echo $json;
			return;
		}
		
		if (empty($senha)) {
		    $response = [
		        'status' => false,
		        'message' => 'Houve algum problema com a senha'
		    ];
		    $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		    echo $json;
		    return;
		}
		
		// Criptografando a senha
		$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
		
		$this->cliente->populate($clienteId, $nome, $email, $senhaHash, $token, $email_verified);
		$result = $this->cliente->save();
		
		if ($result) {
		    // Chama a função de envio de e-mail e captura o retorno
		    $emailResult = enviarEmailConfirmacao($email, $nome, $token);
		    
		    // Se o e-mail for enviado com sucesso, inclui a resposta no resultado
		    if ($emailResult['status']) {
		        $response = [
		            'status' => true,
		            'message' => 'Enviamos um email de confirmação de cadastro'
		        ];
		    } else {
		        $response = [
		            'status' => false,
		            'message' => 'Cadastro realizado, mas houve um erro ao enviar o e-mail de confirmação: ' . $emailResult['message']
		        ];
		    }
		} else {
		    $response = [
		        'status' => false,
		        'message' => 'Houve algum erro ao cadastrar'
		    ];
		}
		
		$json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function put() {
		$token = $this->getParameter('token');
		
		$existingCliente = $this->cliente->listByField('token', $token);
		
		if (!empty($existingCliente) || $existingCliente['token'] != '0') {
		    $email_verified = $existingCliente[0]['email_verified'];
		    
		    if ($email_verified == 0) {
		        $clienteId = $existingCliente[0]["clienteId"];
		        $nome = $existingCliente[0]["nome"];
		        $email = $existingCliente[0]["email"];
		        $senha = $existingCliente[0]["senha"];
		        $token = '0';
		        $email_verified = 1;
		        
		        $this->cliente->populate( $clienteId, $nome, $email, $senha, $token, $email_verified);
		        $result = $this->cliente->save();

		        if ($result) {
		            $response = [
		                'status' => true,
		                'message' => 'Verificação realizada com sucesso'
		            ];
		        } else {
		            $response = [
		                'status' => false,
		                'message' => 'Houve algum erro ao confimar seu email'
		            ];
		        }
		    } else {
		        $response = [
		            'status' => false,
		            'message' => 'Conta já verificada'
		        ];
		    }
		} else {
		    $response = [
		        'status' => false,
		        'message' => 'Conta já verificada ou algum erro com o token'
		    ];
		}
		
		$json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
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
	
	public function eviandoEmail() {
	    $this->cliente->enviarEmail();
	}
}

new CtrlCliente();
?>