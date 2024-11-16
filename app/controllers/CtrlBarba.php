<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Barba;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlBarba extends ControllerHandler {

    private $barba = null;

    public function __construct() {
        $this->barba = new Barba();
        parent::__construct();
    }

    public function get() {
        $data = $this->barba->listAll();
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function post() {
        $barbaId = 0;
        $nomeBarba = $this->getParameter('nomeServico');
        $preco = $this->getParameter('preco');
        $this->barba->populate($barbaId, $nomeBarba, $preco);
        $result = $this->barba->save();
        echo $result;
    }

    public function put() {
        $barbaId = $this->getParameter('barbaId');
        $nomeBarba = $this->getParameter('nomeBarba');
        $preco = $this->getParameter('preco');
        $this->barba->populate($barbaId, $nomeBarba, $preco);
        $result = $this->barba->save();
        echo $result;
    }

    public function delete() {
        $barbaId = $this->getParameter('barbaId');
        $nomeBarba = $this->getParameter('nomeBarba');
        $preco = $this->getParameter('preco');
        $this->barba->populate($barbaId, $nomeBarba, $preco);
        $result = $this->barba->delete();
        echo $result;
    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlBarba();
?>
