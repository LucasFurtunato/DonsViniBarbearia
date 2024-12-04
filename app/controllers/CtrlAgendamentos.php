<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Agendamentos;
use app\models\Funcionario;
use app\models\Servicos;
use app\models\Cliente;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlAgendamentos extends ControllerHandler {

    private $agendamentos = null;
    private $funcionario = null;
    private $servico = null;
    private $cliente = null;

    public function __construct() {
        $this->agendamentos = new Agendamentos();
        $this->funcionario = new Funcionario();
        $this->servico = new Servicos();
        $this->cliente = new Cliente();
        parent::__construct();
    }

    public function get() {
        if (isset($_SESSION["cliente"])) {
            $clienteId = $_SESSION["cliente"]['clienteId'];
            // Obtém todos os agendamentos do cliente
            $agendamentos = $this->agendamentos->listByField("clienteId", $clienteId);
        } else if (isset($_SESSION["funcionario"])){
            $funUnidadeId = $_SESSION["funcionario"]["unidadeId"];
            // Obtém todos os agendamentos baseado na unidade em que o funcionario está registrado
            $agendamentos = $this->agendamentos->listByField('unidadeId', $funUnidadeId);
        }
        
        
        
        if (empty($agendamentos)) {
            echo json_encode(["message" => "Nenhum agendamento encontrado"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            return;
        }
        
        $response = [];
        
        // Itera sobre cada agendamento
        foreach ($agendamentos as $data) {
            $funNome = $this->funcionario->listByField('funcionarioId', $data["funcionarioId"])[0] ?? null;
            $funNome = $funNome ? $funNome["nome"] : null;
            
            $corteNome = $this->servico->listByField('servicosId', $data["corteId"])[0] ?? null;
            $corteNome = $corteNome ? $corteNome["nomeServico"] : null;
            
            $barbaNome = $this->servico->listByField('servicosId', $data["barbaId"])[0] ?? null;
            $barbaNome = $barbaNome ? $barbaNome["nomeServico"] : null;
            
            $cuidadosNome = $this->servico->listByField('servicosId', $data["cuidadosId"])[0] ?? null;
            $cuidadosNome = $cuidadosNome ? $cuidadosNome["nomeServico"] : null;
            
            $clienteNome = $this->cliente->listByField('clienteId', $data["clienteId"])[0] ?? null;
            $clienteNome = $clienteNome ? $clienteNome["nome"] : null;
            
            // Adiciona os dados formatados ao array de resposta
            $response[] = [
                "agendamentosId" => $data["agendamentosId"],
                "barbaNome" => $barbaNome,
                "clienteNome" => $clienteNome,
                "corteNome" => $corteNome,
                "cuidadosNome" => $cuidadosNome,
                "dia" => $data["dia"],
                "funNome" => $funNome,
                "horario" => $data["horario"],
                "preco" => $data["preco"],
                "unidadeId" => $data["unidadeId"]
            ];
        }
        
        // Converte todos os registros para JSON e imprime
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    

    public function post() {
        $agendamentosId = 0;
        $unidadeId = $this->getParameter('unidadeId');
        $funcionarioId = $this->getParameter('funcionarioId');
        $clienteId = $_SESSION["cliente"]["clienteId"];
        $barbaId = $this->getParameter('barbaId');
        $corteId = $this->getParameter('corteId');
        $cuidadosId = $this->getParameter('cuidadosId');
        $preco = $this->getParameter('preco');
        $dia = $this->getParameter('dia');
        $horario = $this->getParameter('horario');
        $this->agendamentos->populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $barbaId, $corteId, $cuidadosId, $preco, $dia, $horario);
        $result = $this->agendamentos->save();
        echo $result;
    }

    public function put() {
        $agendamentosId = $this->getParameter('agendamentosId');
        
        $existingAgendamento = $this->agendamentos->listByField('agendamentosId', $agendamentosId);
        
        if (!empty($existingAgendamento)) {
            $unidadeId = $this->getParameter('unidadeId');
            $funcionarioId = $this->getParameter('funcionarioId');
            $clienteId = $_SESSION["cliente"]["clienteId"];
            $barbaId = $this->getParameter('barbaId');
            $corteId = $this->getParameter('corteId');
            $cuidadosId = $this->getParameter('cuidadosId');
            $preco = $this->getParameter('preco');
            $dia = $this->getParameter('dia');
            $horario = $this->getParameter('horario');
            $this->agendamentos->populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $barbaId, $corteId, $cuidadosId, $preco, $dia, $horario);
            $result = $this->agendamentos->save();
            
            if ($result) {
                $response = [
                    'status' => true,
                    'message' => 'Alteração feita com sucesso'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Houve algum erro ao alterar'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Este serviço não existe'
            ];
        }
        $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function delete() {
        $agendamentosId = $this->getParameter('agendamentosId');
        
        $existingAgendamento = $this->agendamentos->listByField('agendamentosId', $agendamentosId)[0];
        
        if (!empty($existingAgendamento)){
            $unidadeId = $existingAgendamento['unidadeId'];
            $funcionarioId = $existingAgendamento['funcionarioId'];
            $clienteId = $existingAgendamento['clienteId'];
            $barbaId = $existingAgendamento['barbaId'];
            $corteId = $existingAgendamento['corteId'];
            $cuidadosId = $existingAgendamento['cuidadosId'];
            $preco = $existingAgendamento['preco'];
            $dia = $existingAgendamento['dia'];
            $horario = $existingAgendamento['horario'];
            
            $this->agendamentos->populate($agendamentosId, $unidadeId, $funcionarioId, $clienteId, $barbaId, $corteId, $cuidadosId, $preco, $dia, $horario);
            $result = $this->agendamentos->delete();
            
            if ($result) {
                $response = [
                    'status' => true,
                    'message' => 'Este serviço foi excluído'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Houve algum erro ao alterar'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'message' => 'Este serviço não existe'
            ];
        }
        
        $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }

    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlAgendamentos();
?>
