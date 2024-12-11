<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Gerente;


require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlGerente extends ControllerHandler {

	private $gerente = null;

	public function __construct(){
		$this->gerente = new Gerente();
		parent::__construct();
	}

	public function get() {
		$data = $this->gerente->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {
	    $email = $_SESSION["gerente"]["email"];
		$senha = $this->getParameter('senha');

		$existingGerente = $this->gerente->listByField('email', $email);
		
		if (!empty($existingGerente)){
		    $storedHash = $existingGerente[0]['senha'];
		    if (password_verify($senha, $storedHash)){
		        $result = [
		            'status' => true,
		            'message' => 'Senha Correta'
		        ];

		    } else {
		        $result = [
		            'status' => false,
		            'message' => 'Senha Incorreta'
		        ];
		    }
		}
		
		// Codifica o resultado em JSON e envia como resposta
		echo \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	public function put() {		
		$codigo = $this->getParameter('codigo');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$nome = $this->getParameter('nome');
	    $this->gerente->populate( $codigo, $email, $senha, $nome);
		$result = $this->gerente->save();
		echo $result;
	}

	public function delete() {		
		$codigo = $this->getParameter('codigo');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$nome = $this->getParameter('nome');
	    $this->gerente->populate( $codigo, $email, $senha, $nome);
		$result = $this->gerente->delete();
		echo $result;
	}

	public function file(){

	}
}

new CtrlGerente();
?>