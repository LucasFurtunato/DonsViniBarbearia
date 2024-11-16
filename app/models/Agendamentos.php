<?php

namespace app\models;

require_once  dirname(__DIR__, 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Agendamentos {

    private $agendamentosId;
    private $unidadeId;
    private $funcionarioId;
    private $clienteId;
    private $barbaId;
    private $corteId;
    private $cuidadosId;
    private $preco;
    private $dia;
    private $horario;

    private $tableName  = "hostdeprojetos_donvinibarbearia.agendamentos";
    private $fieldsName = "agendamentosId, unidadeId, funcionarioId, clienteId, barbaId, corteId, cuidadosId, preco, dia, horario";
    private $fieldKey   = "agendamentosId";
    private $dbquery     = null;

    function __construct() {
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $barbaId, $corteId, $cuidadosId, $preco, $dia, $horario) {
        $this->setAgendamentosId($agendamentosId);
        $this->setUnidadeId($unidadeId);
        $this->setFuncionarioId($funcionarioId);
        $this->setClienteId($clienteId);
        $this->setBarbaId($barbaId);
        $this->setCorteId($corteId);
        $this->setCuidadosId($cuidadosId);
        $this->setPreco($preco);
        $this->setDia($dia);
        $this->setHorario($horario);
    }

    public function toArray() {
        return array(
            'agendamentosId' => $this->getAgendamentosId(),
            'unidadeId' => $this->getUnidadeId(),
            'funcionarioId' => $this->getFuncionarioId(),
            'clienteId' => $this->getClienteId(),
            'barbaId' => $this->getBarbaId(),
            'corteId' => $this->getCorteId(),
            'cuidadosId' => $this->getCuidadosId(),
            'preco' => $this->getPreco(),
            'dia' => $this->getDia(),
            'horario' => $this->getHorario()
        );
    }

    public function toJson() {
        return(json_encode($this->toArray()));
    }

    public function toString() {
        return("\n\t\t\t" . implode(", ", $this->toArray()));
    }

    public function save() {
        if($this->getAgendamentosId() == 0) {
            return($this->dbquery->insert($this->toArray()));
        } else {
            return($this->dbquery->update($this->toArray()));
        }
    }

    public function listAll() {
        $rSet = $this->dbquery->select();
        return($rSet);
    }

    public function listByFieldKey($value) {
        $where = (new Where())->addCondition('AND', $this->fieldKey, '=', $value);
        $rSet = $this->dbquery->selectWhere($where);
        return($rSet);
    }

    public function delete() {
        if($this->getAgendamentosId() != 0) {
            return($this->dbquery->delete($this->toArray()));
        }
    }

    public function setAgendamentosId($agendamentosId) {
        $this->agendamentosId = $agendamentosId;
    }

    public function getAgendamentosId() {
        return($this->agendamentosId);
    }

    public function setUnidadeId($unidadeId) {
        $this->unidadeId = $unidadeId;
    }

    public function getUnidadeId() {
        return($this->unidadeId);
    }

    public function setFuncionarioId($funcionarioId) {
        $this->funcionarioId = $funcionarioId;
    }

    public function getFuncionarioId() {
        return($this->funcionarioId);
    }

    public function setClienteId($clienteId) {
        $this->clienteId = $clienteId;
    }

    public function getClienteId() {
        return($this->clienteId);
    }

    public function setBarbaId($barbaId) {
        $this->barbaId = $barbaId;
    }

    public function getBarbaId() {
        return($this->barbaId);
    }

    public function setCorteId($corteId) {
        $this->corteId = $corteId;
    }

    public function getCorteId() {
        return($this->corteId);
    }

    public function setCuidadosId($cuidadosId) {
        $this->cuidadosId = $cuidadosId;
    }

    public function getCuidadosId() {
        return($this->cuidadosId);
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return($this->preco);
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }

    public function getDia() {
        return($this->dia);
    }

    public function setHorario($horario) {
        $this->horario = $horario;
    }

    public function getHorario() {
        return($this->horario);
    }
}

?>
