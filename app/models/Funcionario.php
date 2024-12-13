<?php

namespace app\models;

require_once  dirname( __DIR__ , 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;


class Funcionario {

	private $funcionarioId;
	private $codigo;
	private $nome;
	private $email;
	private $unidadeId;
	private $senhaFuncionario;

	private $tableName  = "hostdeprojetos_donvinibarbearia.funcionario";
	private $fieldsName = "funcionarioId, codigo, nome, email, unidadeId, senha";
	private $fieldKey   = "funcionarioId";
	private $dbquery     = null;

	function __construct(){
		$this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
	}

	function populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaFuncionario){

		 $this->setFuncionarioId( $funcionarioId );
		 $this->setCodigo( $codigo );
		 $this->setNome( $nome );
		 $this->setEmail( $email );
		 $this->setUnidadeId( $unidadeId );
		 $this->setsenhaFuncionario( $senhaFuncionario );
	}

	public function toArray(){
		 return array(
			 'funcionarioId' => $this->getFuncionarioId(),
			 'codigo' => $this->getCodigo(),
			 'nome' => $this->getNome(),
			 'email' => $this->getEmail(),
			 'unidadeId' => $this->getUnidadeId(),
			 'senha' => $this->getsenhaFuncionario()
		);
	}

	public function toJson(){
		return( json_encode( $this->toArray() ));
	}

	public function toString(){
		 return("\n\t\t\t". implode(", ",$this->toArray()));
	}


	public function save() {
		if($this->getFuncionarioId() == 0){
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
	public function listByField($fieldName, $value) {
		// Cria uma condição WHERE usando o campo dinâmico
		$where = new Where();
		$where->addCondition('AND', $fieldName, '=', $value);
		
		// Chama o DBQuery passando as condições de WHERE
		$rSet = $this->dbquery->selectWhere($where);
		
		return $rSet;
	}


	public function checkUserExists($email, $senhaFuncionario) {
		// Cria uma condição WHERE usando o campo dinâmico
		$where = new Where();
		$where->addCondition('AND', 'email', '=', $email);
		$where->addCondition('AND', 'senha', '=', $senhaFuncionario);
		$rSet = $this->dbquery->selectWhere($where);
		return $rSet;
	}

	public function delete() {
		if($this->getFuncionarioId() != 0){
			return( $this->dbquery->delete($this->toArray()));
		}
	}

	public function setFuncionarioId( $funcionarioId ){
		 $this->funcionarioId = $funcionarioId;
	}

	public function getFuncionarioId(){
		  return( $this->funcionarioId );
	}

	public function setCodigo( $codigo ){
		 $this->codigo = $codigo;
	}

	public function getCodigo(){
		  return( $this->codigo );
	}

	public function setNome( $nome ){
		 $this->nome = $nome;
	}

	public function getNome(){
		  return( $this->nome );
	}

	public function setEmail( $email ){
		 $this->email = $email;
	}

	public function getEmail(){
		  return( $this->email );
	}

	public function setUnidadeId( $unidadeId ){
		 $this->unidadeId = $unidadeId;
	}

	public function getUnidadeId(){
		  return( $this->unidadeId );
	}

	public function setsenhaFuncionario( $senhaFuncionario ){
		 $this->senhaFuncionario = $senhaFuncionario;
	}

	public function getsenhaFuncionario(){
		  return( $this->senhaFuncionario );
	}

}


?>