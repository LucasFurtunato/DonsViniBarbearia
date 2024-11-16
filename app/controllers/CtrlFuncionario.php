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
		$funcionarioId = $this->getParameter('funcionarioId');
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senha = $this->getParameter('senha');
	    $this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senha);
		$result = $this->funcionario->save();
		echo $result;
	}

	public function put() {		
		$funcionarioId = $this->getParameter('funcionarioId');
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senha = $this->getParameter('senha');
	    $this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senha);
		$result = $this->funcionario->save();
		echo $result;
	}

	public function delete() {		
		$funcionarioId = $this->getParameter('funcionarioId');
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senha = $this->getParameter('senha');
	    $this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senha);
		$result = $this->funcionario->delete();
		echo $result;
	}

	public function file(){

	}
}

new CtrlFuncionario();
?>