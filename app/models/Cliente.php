<?php

namespace app\models;

use app\core\DBQuery;
use app\core\Where;

require_once  dirname( __DIR__ , 1).'/config.php';



class Cliente {

	private $clienteId;
	private $nome;
	private $email;
	private $senha;
	private $token;
	private $email_verified;

	private $tableName  = "ifhostgru_donvinibarbearia.cliente";
	private $fieldsName = "clienteId, nome, email, senha, token, email_verified";
	private $fieldKey   = "clienteId";
	private $dbquery     = null;

	function __construct(){
		$this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
	}

	function populate( $clienteId, $nome, $email, $senha, $token, $email_verified){

		 $this->setClienteId( $clienteId );
		 $this->setNome( $nome );
		 $this->setEmail( $email );
		 $this->setSenha( $senha );
		 $this->setToken( $token );
		 $this->setEmail_verified( $email_verified );
	}

	public function toArray(){
		 return array(
			 'clienteId' => $this->getClienteId(),
			 'nome' => $this->getNome(),
			 'email' => $this->getEmail(),
			 'senha' => $this->getSenha(),
			 'token' => $this->getToken(),
			 'email_verified' => $this->getEmail_verified()
		);
	}

	public function toJson(){
		return( json_encode( $this->toArray() ));
	}

	public function toString(){
		 return("\n\t\t\t". implode(", ",$this->toArray()));
	}


	public function save() {
		if($this->getClienteId() == 0){
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


	public function checkUserExists($email, $senha) {
		// Cria uma condição WHERE usando o campo dinâmico
		$where = new Where();
		$where->addCondition('AND', 'email', '=', $email);
		$where->addCondition('AND', 'senha', '=', $senha);
		$rSet = $this->dbquery->selectWhere($where);
		return $rSet;
	}

	public function delete() {
		if($this->getClienteId() != 0){
			return( $this->dbquery->delete($this->toArray()));
		}
	}

	public function setClienteId( $clienteId ){
		 $this->clienteId = $clienteId;
	}

	public function getClienteId(){
		  return( $this->clienteId );
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

	public function setSenha( $senha ){
		 $this->senha = $senha;
	}

	public function getSenha(){
		  return( $this->senha );
	}

	public function setToken( $token ){
		 $this->token = $token;
	}

	public function getToken(){
		  return( $this->token );
	}

	public function setEmail_verified( $email_verified ){
		 $this->email_verified = $email_verified;
	}

	public function getEmail_verified(){
		  return( $this->email_verified );
	}
}




?>