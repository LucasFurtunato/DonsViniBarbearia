<?php

namespace app\models;

require_once dirname( __DIR__ , 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Empresa {

    private $Idempresa;
    private $unidade;
    private $email;
    private $telefone;
    private $endereco;

    private $tableName  = "hostdeprojetos_donvinibarbearia.empresa";
    private $fieldsName = "Idempresa, unidade, email, telefone, endereco";
    private $fieldKey   = "Idempresa";
    private $dbquery    = null;

    function __construct(){
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($Idempresa, $unidade, $email, $telefone, $endereco){
        $this->setIdempresa($Idempresa);
        $this->setUnidade($unidade);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setEndereco($endereco);
    }

    public function toArray(){
        return array(
            'Idempresa' => $this->getIdempresa(),
            'unidade' => $this->getUnidade(),
            'email' => $this->getEmail(),
            'telefone' => $this->getTelefone(),
            'endereco' => $this->getEndereco()
        );
    }

    public function toJson(){
        return json_encode($this->toArray());
    }

    public function toString(){
        return "\n\t\t\t".implode(", ", $this->toArray());
    }

    public function save() {
        if($this->getIdempresa() == 0){
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
        if($this->getIdempresa() != 0){
            return $this->dbquery->delete($this->toArray());
        }
    }

    // Getters and Setters
    public function setIdempresa($Idempresa) { 
        $this->Idempresa = $Idempresa; 
    }
    public function getIdempresa() { 
        return $this->Idempresa; 
    }

    public function setUnidade($unidade) { 
        $this->unidade = $unidade; 
    }
    public function getUnidade() { 
        return $this->unidade; 
    }

    public function setEmail($email) { 
        $this->email = $email; 
    }
    public function getEmail() { 
        return $this->email; 
    }

    public function setTelefone($telefone) { 
        $this->telefone = $telefone; 
    }
    public function getTelefone() { 
        return $this->telefone; 
    }

    public function setEndereco($endereco) { 
        $this->endereco = $endereco; 
    }
    public function getEndereco() { 
        return $this->endereco; 
    }
}

?>
