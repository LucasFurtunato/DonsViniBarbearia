<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Cuidados;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlCuidados extends ControllerHandler {

    private $cuidados = null;

    public function __construct() {
        $this->cuidados = new Cuidados();
        parent::__construct();
    }

    public function get() {
        $data = $this->cuidados->listAll();
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function post() {
        $cuidadosId = 0;
        $nomeCuidado = $this->getParameter('nomeServico');
        $preco = $this->getParameter('preco');
        $this->cuidados->populate($cuidadosId, $nomeCuidado, $preco);
        $result = $this->cuidados->save();
        
        $existingCuidado = $this->cuidados->listByField('nomeCuidado', $nomeCuidado);
        
        if ($result && !empty($existingCuidado)) {
            $corte = $existingCuidado[0];
            // Retorne os dados do produto criado em JSON
            $produtoCriado = [
                'id' => $corte['cuidadosId'],
                'nomeServico' => $corte['nomeCuidado'],
                'preco' => $corte['preco']
            ];
            echo json_encode($produtoCriado, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['status' => false, 'message' => 'Erro ao salvar produto']);
        }
    }

    public function put() {
        $cuidadosId = $this->getParameter('cuidadosId');
        $nomeCuidado = $this->getParameter('nomeCuidado');
        $preco = $this->getParameter('preco');
        $this->cuidados->populate($cuidadosId, $nomeCuidado, $preco);
        $result = $this->cuidados->save();
        echo $result;
    }

    public function delete() {
        $cuidadosId = $this->getParameter('cuidadosId');
        $nomeCuidado = $this->getParameter('nomeCuidado');
        $preco = $this->getParameter('preco');
        $this->cuidados->populate($cuidadosId, $nomeCuidado, $preco);
        $result = $this->cuidados->delete();
        echo $result;
    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlCuidados();
?>
