<?php

namespace app\models;

require_once dirname( __DIR__ , 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Gerente {

    private $gerenteId;
    private $codigo;
    private $email;
    private $senha;
    private $nome;

    private $tableName  = "hostdeprojetos_donvinibarbearia.gerente";
    private $fieldsName = "gerenteId, codigo, email, senha, nome";
    private $fieldKey   = "gerenteId";
    private $dbquery    = null;

    function __construct(){
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($gerenteId, $codigo, $email, $senha, $nome){
        $this->setGerenteId($gerenteId);
        $this->setCodigo($codigo);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setNome($nome);
    }

    public function toArray(){
        return array(
            'gerenteId' => $this->getGerenteId(),
            'codigo' => $this->getCodigo(),
            'email' => $this->getEmail(),
            'senha' => $this->getSenha(),
            'nome' => $this->getNome()
        );
    }

    public function toJson(){
        return json_encode($this->toArray());
    }

    public function toString(){
        return "\n\t\t\t".implode(", ", $this->toArray());
    }

    public function save() {
        if($this->getGerenteId() == 0){
            return $this->dbquery->insert($this->toArray());
        } else {
            return $this->dbquery->update($this->toArray());
        }
    }

    public function listAll() {
        $rSet = $this->dbquery->select();
        return $rSet;
    }

    public function listByFieldKey($value) {
        $where = (new Where())->addCondition('AND', $this->fieldKey, '=', $value);
        $rSet = $this->dbquery->selectWhere($where);
        return $rSet;
    }

    public function listByField($fieldName, $value) {
        $where = new Where();
        $where->addCondition('AND', $fieldName, '=', $value);
        
        $rSet = $this->dbquery->selectWhere($where);
        return $rSet;
    }

    public function delete() {
        if($this->getGerenteId() != 0){
            return $this->dbquery->delete($this->toArray());
        }
    }

    // Getters and Setters
    public function setGerenteId($gerenteId) { 
        $this->gerenteId = $gerenteId; 
    }
    public function getGerenteId() { 
        return $this->gerenteId; 
    }

    public function setCodigo($codigo) { 
        $this->codigo = $codigo; 
    }
    public function getCodigo() { 
        return $this->codigo; 
    }

    public function setEmail($email) { 
        $this->email = $email; 
    }
    public function getEmail() { 
        return $this->email; 
    }

    public function setSenha($senha) { 
        $this->senha = $senha; 
    }
    public function getSenha() { 
        return $this->senha; 
    }

    public function setNome($nome) { 
        $this->nome = $nome; 
    }
    public function getNome() { 
        return $this->nome; 
    }
}

?>
