<?php



namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Funcionario;



require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlFuncionario extends ControllerHandler {

	private $funcionario = null;

	public function __construct(){
		$this->funcionario = new Funcionario();
		parent::__construct();
	}

	public function get() {
		$data = $this->funcionario->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {		
		$funcionarioId = 0;
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senhaFuncionario = $this->getParameter('senha');
		
		$existingFuncionario = $this->funcionario->listByfield('email', $email);
			
		if (!empty($nome)) {
			if (!empty($existingFuncionario)) {
				$result = [
					'status' => 'error',
					'message' => 'Email já registrado.'
					
				];
				$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				echo $json;
				return;
			}
			// Criptografando a senha
			if (!empty($senhaFuncionario)) {
			    $senhaHash = password_hash($senhaFuncionario, PASSWORD_DEFAULT);
			}
		
			$this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaHash);
    		$result = $this->funcionario->save();
    		$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    		echo $json;
    	} else if (!empty($existingFuncionario)) {
    	    $storedHash = $existingFuncionario[0]['senha'];
    	    if (password_verify($senhaFuncionario, $storedHash)){
    	        $_SESSION["funcionario"]["funcionarioId"] = $existingFuncionario[0]["funcionarioId"];
    	        $_SESSION["funcionario"]["nome"] = $existingFuncionario[0]["nome"];
    	        $_SESSION["funcionario"]["email"] = $existingFuncionario[0]["email"];
    			
    			$result = [
    				'status' => 'true',
    				'message' => 'Login Executado'
    			];
    			$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    			echo $json;
    		} else {
    			$result = [
    				'status' => 'error',
    				'message' => 'Código, email ou senha incorreta'
    			];
    			$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    			echo $json;
    		}
    	} else {
    	    $result = [
    	        'status' => 'error',
    	        'message' => 'Este Funcionario não existe'
    	    ];
    	    $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    	    echo $json;
    	}
	} 

	public function put() {		
		$funcionarioId = $this->getParameter('funcionarioId');
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senhaFuncionario = $this->getParameter('senhaFuncionario');
	    $this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaFuncionario);
		$result = $this->funcionario->save();
		echo $result;
	}

	public function delete() {		
		$funcionarioId = $this->getParameter('funcionarioId');
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senhaFuncionario = $this->getParameter('senhaFuncinario');
	    $this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaFuncionario);
		$result = $this->funcionario->delete();
		echo $result;
	}
	

	public function file(){

	}
}

new CtrlFuncionario();
?>