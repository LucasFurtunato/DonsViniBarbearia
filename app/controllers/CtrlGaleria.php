<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Galeria;



require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlGaleria extends ControllerHandler {

	private $galeria = null;

	public function __construct(){
		$this->galeria = new Galeria();
		parent::__construct();
	}

	public function get() {
		$data = $this->galeria->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {		
		$galeriaId = $this->getParameter('galeriaId');
		$localizacao = $this->getParameter('localizacao');
		$imagem = $this->getParameter('imagem');
	    $this->galeria->populate( $galeriaId, $localizacao, $imagem);
		$result = $this->galeria->save();
		echo $result;
	}

	public function put() {		
		$galeriaId = $this->getParameter('galeriaId');
		$localizacao = $this->getParameter('localizacao');
		$imagem = $this->getParameter('imagem');
	    $this->galeria->populate( $galeriaId, $localizacao, $imagem);
		$result = $this->galeria->save();
		echo $result;
	}

	public function delete() {		
		$galeriaId = $this->getParameter('galeriaId');
		$localizacao = $this->getParameter('localizacao');
		$imagem = $this->getParameter('imagem');
	    $this->galeria->populate( $galeriaId, $localizacao, $imagem);
		$result = $this->galeria->delete();
		echo $result;
	}

	public function file(){

	}
}

new CtrlGaleria();
?>