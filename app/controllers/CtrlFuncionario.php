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
		$this->funcionario = new Funcionario();
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
		$senhaFuncionario = $this->getParameter('senhaFuncionario');
		
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
		
		$this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaFuncionario);
		$result = $this->funcionario->save();
		$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	} else if (!empty($existingFuncionario)) {
		$validationUser = $this->funcionario->checkUserExists($email, $senhaFuncionario);
		if (!empty($validationUser)){
			$funcionario = $validationUser[0];
			$nome = $funcionario['nome'];
			
			$_SESSION["funcionario"] = $nome;
			
			$result = [
				'status' => 'true',
				'message' => 'Login Executado'
			];
			$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			echo $json;
		} else {
			$result = [
				'status' => 'error',
				'message' => 'Funcionario não registrado.'
			];
			$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			echo $json;
		}
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