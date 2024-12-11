<?php

namespace app\models;

require_once dirname(__DIR__, 1).'/config.php';

use app\core\DBQuery;
use app\core\Where;

class Servicos {

    private $servicosId;
    private $tipoServico;
    private $nomeServico;
    private $preco;

    private $tableName  = "ifhostgru_donvinibarbearia.servicos";
    private $fieldsName = "servicosId, tipoServico, nomeServico, preco";
    private $fieldKey   = "servicosId";
    private $dbquery    = null;

    function __construct() {
        $this->dbquery = new DBQuery($this->tableName, $this->fieldsName, $this->fieldKey);
    }

    function populate($servicosId, $tipoServico, $nomeServico, $preco) {
        $this->setServicosId($servicosId);
        $this->setTipoServico($tipoServico);
        $this->setNomeServico($nomeServico);
        $this->setPreco($preco);
    }

    public function toArray() {
        return array(
            'servicosId' => $this->getServicosId(),
            'tipoServico' => $this->getTipoServico(),
            'nomeServico' => $this->getNomeServico(),
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
        if ($this->getServicosId() == 0) {
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
        if ($this->getServicosId() != 0) {
            return $this->dbquery->delete($this->toArray());
        }
    }

    public function setServicosId($servicosId) {
        $this->servicosId = $servicosId;
    }

    public function getServicosId() {
        return $this->servicosId;
    }

    public function setTipoServico($tipoServico) {
        $this->tipoServico = $tipoServico;
    }

    public function getTipoServico() {
        return $this->tipoServico;
    }

    public function setNomeServico($nomeServico) {
        $this->nomeServico = $nomeServico;
    }

    public function getNomeServico() {
        return $this->nomeServico;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }
}

?>
