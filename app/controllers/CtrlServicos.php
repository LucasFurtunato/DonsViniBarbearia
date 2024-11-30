<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Servicos;
use app\models\Agendamentos;

require_once dirname(__DIR__, 1).'/config.php';

class CtrlServicos extends ControllerHandler {

    private $servicos = null;
    private $agendamentos = null;

    public function __construct() {
        $this->servicos = new Servicos();
        $this->agendamentos = new Agendamentos();
        parent::__construct();
    }

    public function get() {
        //$data = $this->servicos->listAll();
        // Buscar dados de Corte
        $dataCorte = $this->servicos->listByField('tipoServico', 'Corte');
        
        // Buscar dados de Barba
        $dataBarba = $this->servicos->listByField('tipoServico', 'Barba');
        
        // Buscar dados de Cuidados
        $dataCuidados = $this->servicos->listByField('tipoServico', 'Cuidados');
        
        // Consolidar dados em uma única resposta
        $data = [
            'cortes' => $dataCorte,
            'barbas' => $dataBarba,
            'cuidados' => $dataCuidados
        ];
        $json = \json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
    }
    
    public function post() {
        $servicosId = 0;
        $tipoServico = $this->getParameter('tipoServico');
        $nomeServico = $this->getParameter('nomeServico');
        $preco = $this->getParameter('preco');
        
        $existingServico = $this->servicos->listByField('nomeServico', $nomeServico);
        
        if (!empty($existingServico)) {
            $response = [
                'status' => false,
                'message' => 'Produto já criado, por favor apenas exclua o que já existe ou apenas o altere'
            ];
            $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            echo $json;
            return;
        }
        
        $this->servicos->populate($servicosId, $tipoServico, $nomeServico, $preco);
        $result = $this->servicos->save();
        
        $createdServico = $this->servicos->listByField('nomeServico', $nomeServico);
        
        if ($result && !empty($createdServico)) {
            $servico = $createdServico[0];
            // Retorne os dados do produto criado em JSON
            $produtoCriado = [
                'id' => $servico['servicosId'],
                'tipoServico' => $servico['tipoServico'],
                'nomeServico' => $servico['nomeServico'],
                'preco' => $servico['preco']
            ];
            $json = \json_encode($produtoCriado, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            echo $json;
        } else {
            $result = [
                'status' => false, 
                'message' => 'Erro ao salvar produto'
            ];
            $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            echo $json;
        }
    }

    public function put() {
        $servicosId = $this->getParameter('idServico');
        $tipoServico = $this->getParameter('alterarTipoServico');
        $nomeServico = $this->getParameter('alterarNomeServico');
        $preco = $this->getParameter('alterarPreco');
        
        $existingServico = $this->servicos->listByField('servicosId', $servicosId);
        
        if (!empty($existingServico)) {
            $this->servicos->populate($servicosId, $tipoServico, $nomeServico, $preco);
            $result = $this->servicos->save();
            
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
        $servicosId = $this->getParameter('servicosId');
        
        // Verifica se o serviço existe
        $existingServico = $this->servicos->listByField('servicosId', $servicosId)[0];
        if (empty($existingServico)) {
            $response = [
                'status' => false,
                'message' => 'Este serviço não existe'
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            return;
        }
        
        $tipoServico = $existingServico['tipoServico'];
        $nomeServico = $existingServico['nomeServico'];
        $preco = $existingServico['preco'];
        
        // Atualiza os agendamentos relacionados
        if (!$this->putAgendamentos($servicosId)) {
            $response = [
                'status' => false,
                'message' => 'Erro ao atualizar os agendamentos'
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            return;
        }
        
        // Exclui o serviço
        $this->servicos->populate($servicosId, $tipoServico, $nomeServico, $preco);
        $result = $this->servicos->delete();
        
        $response = [
            'status' => $result,
            'message' => $result ? 'Este serviço foi excluído' : 'Houve algum erro ao excluir'
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    public function putAgendamentos($idServico) {
        $servicosId = $idServico;
        
        // Atualiza todos os agendamentos relacionados
        $updated = true;
        $fields = ['corteId', 'barbaId', 'cuidadosId'];
        foreach ($fields as $field) {
            $agendamentos = $this->agendamentos->listByField($field, $servicosId);
            foreach ($agendamentos as $agendamento) {
                if (!$this->updateField($agendamento, $field, 1)) {
                    $updated = false;
                }
            }
        }
        
        return $updated;
    }
    
    private function updateField(array $existing, string $fieldToUpdate, $newValue) {
        $existing[$fieldToUpdate] = $newValue;
        
        $this->agendamentos->populate(
            $existing['agendamentosId'],
            $existing['unidadeId'],
            $existing['funcionarioId'],
            $existing['clienteId'],
            $existing['barbaId'] ?? null,
            $existing['corteId'] ?? null,
            $existing['cuidadosId'] ?? null,
            $existing['preco'],
            $existing['dia'],
            $existing['horario']
            );
        
        return $this->agendamentos->save();
    }
    
    



    public function file() {
        // Implement file handling if necessary
    }
}

new CtrlServicos();
?>
