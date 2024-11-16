<?php

namespace app\models;

require_once dirname(__DIR__, 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Cuidados {

    private $cuidadosId;
    private $nomeCuidado;
    private $preco;

    private $tableName  = "hostdeprojetos_donvinibarbearia.cuidados";
    private $fieldsName = "cuidadosId, nomeCuidado, preco";
    private $fieldKey   = "cuidadosId";
    private $dbquery    = null;

    function __construct() {
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($cuidadosId, $nomeCuidado, $preco) {
        $this->setCuidadosId($cuidadosId);
        $this->setNomeCuidado($nomeCuidado);
        $this->setPreco($preco);
    }

    public function toArray() {
        return array(
            'cuidadosId' => $this->getCuidadosId(),
            'nomeCuidado' => $this->getNomeCuidado(),
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
        if ($this->getCuidadosId() == 0) {
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
        if ($this->getCuidadosId() != 0) {
            return $this->dbquery->delete($this->toArray());
        }
    }

    public function setCuidadosId($cuidadosId) {
        $this->cuidadosId = $cuidadosId;
    }

    public function getCuidadosId() {
        return $this->cuidadosId;
    }

    public function setNomeCuidado($nomeCuidado) {
        $this->nomeCuidado = $nomeCuidado;
    }

    public function getNomeCuidado() {
        return $this->nomeCuidado;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }
}

?>
