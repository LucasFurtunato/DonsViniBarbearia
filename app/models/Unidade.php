<?php

namespace app\models;

require_once  dirname( __DIR__ , 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;


class Unidade {

	private $unidadeId;
	private $cep;
	private $logradouro;
	private $numero;
	private $complemento;
	private $bairro;
	private $cidade;
	private $uf;

	private $tableName  = "ifhostgru_donvinibarbearia.unidade";
	private $fieldsName = "unidadeId, cep, logradouro, numero, complemento, bairro, cidade, uf";
	private $fieldKey   = "unidadeId";
	private $dbquery     = null;

	function __construct(){
		$this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
	}

	function populate( $unidadeId, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf){

		 $this->setUnidadeId( $unidadeId );
		 $this->setCep( $cep );
		 $this->setLogradouro( $logradouro );
		 $this->setNumero( $numero );
		 $this->setComplemento( $complemento );
		 $this->setBairro( $bairro );
		 $this->setCidade( $cidade );
		 $this->setUf( $uf );
	}

	public function toArray(){
		 return array(
			 'unidadeId' => $this->getUnidadeId(),
			 'cep' => $this->getCep(),
			 'logradouro' => $this->getLogradouro(),
			 'numero' => $this->getNumero(),
			 'complemento' => $this->getComplemento(),
			 'bairro' => $this->getBairro(),
			 'cidade' => $this->getCidade(),
			 'uf' => $this->getUf()
		);
	}

	public function toJson(){
		return( json_encode( $this->toArray() ));
	}

	public function toString(){
		 return("\n\t\t\t". implode(", ",$this->toArray()));
	}


	public function save() {
		if($this->getUnidadeId() == 0){
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
		if($this->getUnidadeId() != 0){
			return( $this->dbquery->delete($this->toArray()));
		}
	}

	public function setUnidadeId( $unidadeId ){
		 $this->unidadeId = $unidadeId;
	}

	public function getUnidadeId(){
		  return( $this->unidadeId );
	}

	public function setCep( $cep ){
		 $this->cep = $cep;
	}

	public function getCep(){
		  return( $this->cep );
	}

	public function setLogradouro( $logradouro ){
		 $this->logradouro = $logradouro;
	}

	public function getLogradouro(){
		  return( $this->logradouro );
	}

	public function setNumero( $numero ){
		 $this->numero = $numero;
	}

	public function getNumero(){
		  return( $this->numero );
	}

	public function setComplemento( $complemento ){
		 $this->complemento = $complemento;
	}

	public function getComplemento(){
		  return( $this->complemento );
	}

	public function setBairro( $bairro ){
		 $this->bairro = $bairro;
	}

	public function getBairro(){
		  return( $this->bairro );
	}

	public function setCidade( $cidade ){
		 $this->cidade = $cidade;
	}

	public function getCidade(){
		  return( $this->cidade );
	}

	public function setUf( $uf ){
		 $this->uf = $uf;
	}

	public function getUf(){
		  return( $this->uf );
	}

}


?>