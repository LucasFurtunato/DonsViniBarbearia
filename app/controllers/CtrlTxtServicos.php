<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\TxtServicos;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlTxtServicos extends ControllerHandler {
    
    private $txtServicos = null;
    
    public function __construct() {
        $this->txtServicos = new TxtServicos();
        parent::__construct();
    }
    
    public function get() {
        $data = $this->txtServicos->listAll();
        $json = \json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }
    
    public function post() {
        $txtServicosId = $this->getParameter('txtServicosId');
        $localizacao = $this->getParameter('localizacao');
        $texto1 = $this->getParameter('texto1');
        $texto2 = $this->getParameter('texto2');
        
        $this->txtServicos->populate($txtServicosId, $localizacao, $texto1, $texto2);
        $result = $this->txtServicos->save();
        echo $result;
    }
    
    public function put() {
        $txtServicosId = $this->getParameter('txtServicosId');
        $localizacao = $this->getParameter('localizacao');
        $texto1 = $this->getParameter('texto1');
        $texto2 = $this->getParameter('texto2');
        
        $this->txtServicos->populate($txtServicosId, $localizacao, $texto1, $texto2);
        $result = $this->txtServicos->save();
        echo $result;
    }
    
    public function delete() {
        $txtServicosId = $this->getParameter('txtServicosId');
        $localizacao = $this->getParameter('localizacao');
        $texto1 = $this->getParameter('texto1');
        $texto2 = $this->getParameter('texto2');
        
        $this->txtServicos->populate($txtServicosId, $localizacao, $texto1, $texto2);
        $result = $this->txtServicos->delete();
        echo $result;
    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlTxtServicos();
?>
