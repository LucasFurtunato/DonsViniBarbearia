<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Agendamentos;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlAgendamentos extends ControllerHandler {

    private $agendamentos = null;

    public function __construct() {
        $this->agendamentos = new Agendamentos();
        parent::__construct();
    }

    public function get() {
        $data = $this->agendamentos->listAll();
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function post() {
        $agendamentosId = 0;
        $unidadeId = 1; //por enquanto fica assim
        $funcionarioId = $this->getParameter('funcionarioId');
        $clienteId = 1;
        $servicosId = $this->getParameter('servicosId');
        $preco = $this->getParameter('preco');
        $dia = $this->getParameter('dia');
        $horario = $this->getParameter('horario');
        $this->agendamentos->populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $servicosId, $preco, $dia, $horario);
        $result = $this->agendamentos->save();
        echo $result;
    }

    public function put() {
        $agendamentosId = $this->getParameter('agendamentosId');
        $unidadeId = $this->getParameter('unidadeId');
        $funcionarioId = $this->getParameter('funcionarioId');
        $clienteId = $this->getParameter('clienteId');
        $servicosId = $this->getParameter('servicosId');
        $preco = $this->getParameter('preco');
        $dia = $this->getParameter('dia');
        $horario = $this->getParameter('horario');
        $this->agendamentos->populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $servicosId, $preco, $dia, $horario);
        $result = $this->agendamentos->save();
        echo $result;
    }

    public function delete() {
        $agendamentosId = $this->getParameter('agendamentosId');
        $unidadeId = $this->getParameter('unidadeId');
        $funcionarioId = $this->getParameter('funcionarioId');
        $clienteId = $this->getParameter('clienteId');
        $servicosId = $this->getParameter('servicosId');
        $preco = $this->getParameter('preco');
        $dia = $this->getParameter('dia');
        $horario = $this->getParameter('horario');
        $this->agendamentos->populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $servicosId, $preco, $dia, $horario);
        $result = $this->agendamentos->delete();
        echo $result;
    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlAgendamentos();
?>
