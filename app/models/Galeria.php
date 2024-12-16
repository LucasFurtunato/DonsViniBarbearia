<?php

namespace app\models;

require_once  dirname( __DIR__ , 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;


class Galeria {

	private $galeriaId;
	private $localizacao;
	private $imagem;

	private $tableName  = "hostdeprojetos_donvinibarbearia.galeria";
	private $fieldsName = "galeriaId, localizacao, imagem";
	private $fieldKey   = "galeriaId";
	private $dbquery     = null;

	function __construct(){
		$this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
	}

	function populate( $galeriaId, $localizacao, $imagem){

		 $this->setGaleriaId( $galeriaId );
		 $this->setLocalizacao( $localizacao );
		 $this->setImagem( $imagem );
	}

	public function toArray(){
		 return array(
			 'galeriaId' => $this->getGaleriaId(),
			 'localizacao' => $this->getLocalizacao(),
			 'imagem' => $this->getImagem()
		);
	}

	public function toJson(){
		return( json_encode( $this->toArray() ));
	}

	public function toString(){
		 return("\n\t\t\t". implode(", ",$this->toArray()));
	}


	public function save() {
		if($this->getGaleriaId() == 0){
			return( $this->dbquery->insert($this->toArray()));
		}else{
			return( $this->dbquery->update($this->toArray()));
		}
	}

	public function listAll() {
		    $rSet = $this->dbquery->select();
		    return( $rSet );
	}

	public function listByFieldKey( $value ){
		    $where = (new Where())->addCondition('AND', $this->fieldKey , '=', $value);
		    $rSet = $this->dbquery->selectWhere($where);
		    return( $rSet );
	}

	public function delete() {
		if($this->getGaleriaId() != 0){
			return( $this->dbquery->delete($this->toArray()));
		}
	}

	public function setGaleriaId( $galeriaId ){
		 $this->galeriaId = $galeriaId;
	}

	public function getGaleriaId(){
		  return( $this->galeriaId );
	}

	public function setLocalizacao( $localizacao ){
		 $this->localizacao = $localizacao;
	}

	public function getLocalizacao(){
		  return( $this->localizacao );
	}

	public function setImagem( $imagem ){
		 $this->imagem = $imagem;
	}

	public function getImagem(){
		  return( $this->imagem );
	}

}


?>