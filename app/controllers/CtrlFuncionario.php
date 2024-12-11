<?php



namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Funcionario;
use app\models\Agendamentos;



require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlFuncionario extends ControllerHandler {

	private $funcionario = null;
	private $agendamentos = null;
	
	public function __construct(){
		$this->funcionario = new Funcionario();
		$this->agendamentos = new Agendamentos();
		parent::__construct();
	}

	public function get() {
		$data = $this->funcionario->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {		
		$funcionarioId = 0;
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senhaFuncionario = $this->getParameter('senhaFuncionario');
		
		$existingFuncionario = $this->funcionario->listByfield('email', $email);
			
		if (!empty($nome)) {
			if (!empty($existingFuncionario)) {
				$result = [
					'status' => 'error',
					'message' => 'Email já registrado.'
					
				];
				$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				echo $json;
				return;
			}
			// Criptografando a senha
			if (!empty($senhaFuncionario)) {
			    $senhaHash = password_hash($senhaFuncionario, PASSWORD_DEFAULT);
			}
		
			$this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaHash);
    		$result = $this->funcionario->save();
    		$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    		echo $json;
    	}
	} 

	public function put() {		
		$funcionarioId = $this->getParameter('funcionarioId');
		
		if (empty($funcionarioId)) {
		    $funcionarioId = $_SESSION["funcionario"]["funcionarioId"];
		    if (empty($funcionarioId)) {
		        $response = [
		            'status' => false,
		            'message' => 'Houve algum erro ao alterar'
		        ];
		        
		        $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		        echo $json;
		        return ;
		    }
		}
		
		$codigo = $this->getParameter('codigo');
		$nome = $this->getParameter('nome');
		$email = $this->getParameter('email');
		$unidadeId = $this->getParameter('unidadeId');
		$senhaFuncionario = $this->getParameter('senhaFuncionario');
		
		$existingFuncionario = $this->funcionario->listByField('funcionarioId', $funcionarioId);
		// Criptografando a senha
		if (!empty($senhaFuncionario)) {
			$senhaHash = password_hash($senhaFuncionario, PASSWORD_DEFAULT);
			}

		if (!empty($existingFuncionario)) {
            $this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaHash);
			$result = $this->funcionario->save();
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
		}else {
            $response = [
                'status' => false,
                'message' => 'Este funcionario não existe'
            ];
        }
        $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json;
	}

	public function delete() {		
		
		$funcionarioId = $this->getParameter('funcionarioId');
		$existingFuncionario = $this->funcionario->listByField('funcionarioId', $funcionarioId)[0];
	    if (empty($existingFuncionario)) {
	        $response = [
	            'status' => false,
	            'message' => 'Este funcionário não existe'
	        ];
	        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	        return;
	    }
	    $codigo = $existingFuncionario['codigo'];
	    $nome = $existingFuncionario['nome'];
	    $email = $existingFuncionario['email'];
	    $unidadeId =$existingFuncionario['unidadeId'];
	    $senhaFuncionario = $existingFuncionario['senha'];
	    // Atualiza os agendamentos relacionados
	    if (!$this->putAgendamentos($funcionarioId)) {
	        $response = [
	            'status' => false,
	            'message' => 'Erro ao atualizar os agendamentos'
	        ];
	        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	        return;
	    }
			
		$this->funcionario->populate( $funcionarioId, $codigo, $nome, $email, $unidadeId, $senhaFuncionario);
		$result = $this->funcionario->delete();
        
		$response = [
		    'status' => $result,
		    'message' => $result ? 'Este funcionário foi excluído' : 'Houve algum erro ao excluir'
		];
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
    }
    public function putAgendamentos($Idfuncionario) {
        $funcionarioId = $Idfuncionario;
        
        // Atualiza todos os agendamentos relacionados
        $updated = true;
        $agendamentos = $this->agendamentos->listByField("funcionarioId", $funcionarioId);
        foreach ($agendamentos as $agendamento) {
            if (!$this->updateField($agendamento, "funcionarioId", 1)) {
                $updated = false;
            }
        }
        
        return $updated;
    }
    private function updateField(array $existing, string $fieldToUpdate, $newValue) {
        $existing[$fieldToUpdate] = $newValue;
        
        $this->agendamentos->populate(
            $existing['agendamentosId'],
            $existing['unidadeId'],
            $existing['funcionarioId'] ?? null,
            $existing['clienteId'],
            $existing['barbaId'],
            $existing['corteId'],
            $existing['cuidadosId'],
            $existing['preco'],
            $existing['dia'],
            $existing['horario']
            );
        
        return $this->agendamentos->save();
    }
    
		
}



new CtrlFuncionario();
?>