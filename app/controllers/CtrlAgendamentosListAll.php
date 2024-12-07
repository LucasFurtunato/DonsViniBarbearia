<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Agendamentos;
use app\models\Funcionario;
use app\models\Servicos;
use app\models\Cliente;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlAgendamentosListAll extends ControllerHandler {

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

    }

    public function put() {

    }

    public function delete() {

    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlAgendamentosListAll();
?>
