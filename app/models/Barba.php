<?php

namespace app\models;

require_once dirname(__DIR__, 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Barba {

    private $barbaId;
    private $nomeBarba;
    private $preco;

    private $tableName  = "hostdeprojetos_donvinibarbearia.barba";
    private $fieldsName = "barbaId, nomeBarba, preco";
    private $fieldKey   = "barbaId";
    private $dbquery     = null;

    function __construct() {
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($barbaId, $nomeBarba, $preco) {
        $this->setBarbaId($barbaId);
        $this->setNomeBarba($nomeBarba);
        $this->setPreco($preco);
    }

    public function toArray() {
        return array(
            'barbaId' => $this->getBarbaId(),
            'nomeBarba' => $this->getNomeBarba(),
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
        if ($this->getBarbaId() == 0) {
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

    public function delete() {
        if ($this->getBarbaId() != 0) {
            return $this->dbquery->delete($this->toArray());
        }
    }

    public function setBarbaId($barbaId) {
        $this->barbaId = $barbaId;
    }

    public function getBarbaId() {
        return $this->barbaId;
    }

    public function setNomeBarba($nomeBarba) {
        $this->nomeBarba = $nomeBarba;
    }

    public function getNomeBarba() {
        return $this->nomeBarba;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }
}

?>
