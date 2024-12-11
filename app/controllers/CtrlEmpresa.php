<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Empresa;

require_once dirname( __DIR__ , 1).'/config.php';

class CtrlEmpresa extends ControllerHandler {

    private $empresa = null;

    public function __construct(){
        $this->empresa = new Empresa();
        parent::__construct();
    }

    public function get() {
        $data = $this->empresa->listAll();
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function post() {        
        $Idempresa = $this->getParameter('Idempresa');
        $unidade = $this->getParameter('unidade');
        $email = $this->getParameter('email');
        $telefone = $this->getParameter('telefone');
        $endereco = $this->getParameter('endereco');

        $this->empresa->populate($Idempresa, $unidade, $email, $telefone, $endereco);
        $result = $this->empresa->save();
        echo $result;
    }

    public function put() {        
        $Idempresa = $this->getParameter('Idempresa');
        $unidade = $this->getParameter('unidade');
        $email = $this->getParameter('email');
        $telefone = $this->getParameter('telefone');
        $endereco = $this->getParameter('endereco');

        $this->empresa->populate($Idempresa, $unidade, $email, $telefone, $endereco);
        $result = $this->empresa->save();
        echo $result;
    }

    public function delete() {        
        $Idempresa = $this->getParameter('Idempresa');
        $unidade = $this->getParameter('unidade');
        $email = $this->getParameter('email');
        $telefone = $this->getParameter('telefone');
        $endereco = $this->getParameter('endereco');

        $this->empresa->populate($Idempresa, $unidade, $email, $telefone, $endereco);
        $result = $this->empresa->delete();
        echo $result;
    }

    public function file(){

    }
}

new CtrlEmpresa();

?>
