<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Corte;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlCorte extends ControllerHandler {

    private $corte = null;

    public function __construct() {
        $this->corte = new Corte();
        parent::__construct();
    }

    public function get() {
        $data = $this->corte->listAll();
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function post() {
        $corteId = $this->getParameter('corteId');
        $nomeCorte = $this->getParameter('nomeCorte');
        $preco = $this->getParameter('preco');
        $this->corte->populate($corteId, $nomeCorte, $preco);
        $result = $this->corte->save();
        echo $result;
    }

    public function put() {
        $corteId = $this->getParameter('corteId');
        $nomeCorte = $this->getParameter('nomeCorte');
        $preco = $this->getParameter('preco');
        $this->corte->populate($corteId, $nomeCorte, $preco);
        $result = $this->corte->save();
        echo $result;
    }

    public function delete() {
        $corteId = $this->getParameter('corteId');
        $nomeCorte = $this->getParameter('nomeCorte');
        $preco = $this->getParameter('preco');
        $this->corte->populate($corteId, $nomeCorte, $preco);
        $result = $this->corte->delete();
        echo $result;
    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlCorte();
?>
