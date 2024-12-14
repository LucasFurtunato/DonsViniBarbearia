<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Unidade;

require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlUnidade extends ControllerHandler {

	private $unidade = null;

	public function __construct(){
		$this->unidade = new Unidade();
		parent::__construct();
	}

	public function get() {
		$data = $this->unidade->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {		
		$unidadeId = $this->getParameter('unidadeId');
		$cep = $this->getParameter('cep');
		$logradouro = $this->getParameter('logradouro');
		$numero = $this->getParameter('numero');
		$complemento = $this->getParameter('complemento');
		$bairro = $this->getParameter('bairro');
		$cidade = $this->getParameter('cidade');
		$uf = $this->getParameter('uf');
	    $this->unidade->populate( $unidadeId, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf);
		$result = $this->unidade->save();
		echo $result;
	}

	public function put() {		
		$unidadeId = $this->getParameter('unidadeId');
		$cep = $this->getParameter('cep');
		$logradouro = $this->getParameter('logradouro');
		$numero = $this->getParameter('numero');
		$complemento = $this->getParameter('complemento');
		$bairro = $this->getParameter('bairro');
		$cidade = $this->getParameter('cidade');
		$uf = $this->getParameter('uf');
	    $this->unidade->populate( $unidadeId, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf);
		$result = $this->unidade->save();
		echo $result;
	}

	public function delete() {		
		$unidadeId = $this->getParameter('unidadeId');
		$cep = $this->getParameter('cep');
		$logradouro = $this->getParameter('logradouro');
		$numero = $this->getParameter('numero');
		$complemento = $this->getParameter('complemento');
		$bairro = $this->getParameter('bairro');
		$cidade = $this->getParameter('cidade');
		$uf = $this->getParameter('uf');
	    $this->unidade->populate( $unidadeId, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf);
		$result = $this->unidade->delete();
		echo $result;
	}

	public function file(){

	}
}

new CtrlUnidade();
?>