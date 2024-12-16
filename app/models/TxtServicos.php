<?php

namespace app\models;

require_once dirname( __DIR__ , 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class TxtServicos {

    private $txtServicosId;
    private $localizacao;
    private $texto1;
    private $texto2;

    private $tableName  = "ifhostgru_donvinibarbearia.txtServicos";
    private $fieldsName = "txtServicosId, localizacao, texto1, texto2";
    private $fieldKey   = "txtServicosId";
    private $dbquery    = null;

    function __construct(){
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($txtServicosId, $localizacao, $texto1, $texto2){
        $this->setTxtServicosId($txtServicosId);
        $this->setLocalizacao($localizacao);
        $this->setTexto1($texto1);
        $this->setTexto2($texto2);
    }

    public function toArray(){
        return array(
            'txtServicosId' => $this->getTxtServicosId(),
            'localizacao' => $this->getLocalizacao(),
            'texto1' => $this->getTexto1(),
            'texto2' => $this->getTexto2()
        );
    }

    public function toJson(){
        return json_encode($this->toArray());
    }

    public function toString(){
        return "\n\t\t\t".implode(", ", $this->toArray());
    }

    public function save() {
        if($this->getTxtServicosId() == 0){
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
        if($this->getTxtServicosId() != 0){
            return $this->dbquery->delete($this->toArray());
        }
    }

    // Getters and Setters
    public function setTxtServicosId($txtServicosId) { 
        $this->txtServicosId = $txtServicosId; 
    }
    public function getTxtServicosId() { 
        return $this->txtServicosId; 
    }

    public function setLocalizacao($localizacao) { 
        $this->localizacao = $localizacao; 
    }
    public function getLocalizacao() { 
        return $this->localizacao; 
    }

    public function setTexto1($texto1) { 
        $this->texto1 = $texto1; }
    public function getTexto1() { 
        return $this->texto1; 
    }

    public function setTexto2($texto2) { 
        $this->texto2 = $texto2; 
    }
    public function getTexto2() { 
        return $this->texto2; 
    }
}

?>
