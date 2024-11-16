<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Corte;
use app\models\Barba;
use app\models\Cuidados;

require_once dirname(__DIR__, 1).'/config.php';

class GetProdutosCombinados extends ControllerHandler {

    private $corte = null;
    private $barba = null;
    private $cuidados = null;

    public function __construct() {
        $this->corte = new Corte();
        $this->barba = new Barba();
        $this->cuidados = new Cuidados();
        parent::__construct();
    }

    public function get() {
        // Buscar dados de Corte
        $dataCorte = $this->corte->listAll();

        // Buscar dados de Barba
        $dataBarba = $this->barba->listAll();

        // Buscar dados de Cuidados
        $dataCuidados = $this->cuidados->listAll();

        // Consolidar dados em uma única resposta
        $data = [
            'cortes' => $dataCorte,
            'barbas' => $dataBarba,
            'cuidados' => $dataCuidados
        ];

        // Retornar como JSON
        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }
}

// Inicializar o controlador
new GetProdutosCombinados();
?>
