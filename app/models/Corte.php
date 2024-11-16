<?php

namespace app\models;

require_once dirname(__DIR__, 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Corte {

    private $corteId;
    private $nomeCorte;
    private $preco;

    private $tableName  = "hostdeprojetos_donvinibarbearia.corte";
    private $fieldsName = "corteId, nomeCorte, preco";
    private $fieldKey   = "corteId";
    private $dbquery    = null;

    function __construct() {
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($corteId, $nomeCorte, $preco) {
        $this->setCorteId($corteId);
        $this->setNomeCorte($nomeCorte);
        $this->setPreco($preco);
    }

    public function toArray() {
        return array(
            'corteId' => $this->getCorteId(),
            'nomeCorte' => $this->getNomeCorte(),
            'preco' => $this->getPreco(),
        );
    }

    public function toJson() {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function toString() {
        return "\n\t\t\t" . implode(", ", $this->toArray());
    }

    public function save() {
        if ($this->getCorteId() == 0) {
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
        // Cria uma condição WHERE usando o campo dinâmico
        $where = new Where();
        $where->addCondition('AND', $fieldName, '=', $value);
        
        // Chama o DBQuery passando as condições de WHERE
        $rSet = $this->dbquery->selectWhere($where);
        
        return $rSet;
    }

    public function delete() {
        if ($this->getCorteId() != 0) {
            return $this->dbquery->delete($this->toArray());
        }
    }

    public function setCorteId($corteId) {
        $this->corteId = $corteId;
    }

    public function getCorteId() {
        return $this->corteId;
    }

    public function setNomeCorte($nomeCorte) {
        $this->nomeCorte = $nomeCorte;
    }

    public function getNomeCorte() {
        return $this->nomeCorte;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }
}

?>
