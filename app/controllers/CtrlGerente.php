<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Gerente;


require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlGerente extends ControllerHandler {

	private $gerente = null;

	public function __construct(){
		$this->gerente = new Gerente();
		parent::__construct();
	}

	public function get() {
		$data = $this->gerente->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {
	    
	    $email = $_SESSION["gerente"]["email"];
		$senha = $this->getParameter('senha');

		$existingGerente = $this->gerente->listByField('email', $email);
		
		if (!empty($existingGerente)){
		    $storedHash = $existingGerente[0]['senha'];
		    if (password_verify($senha, $storedHash)){
		        $_SESSION["gerente"]["gerenteId"] = 1;
		        $result = [
		            'status' => true,
		            'message' => 'Senha Correta'
		        ];

		    } else {
		        $result = [
		            'status' => false,
		            'message' => 'Senha Incorreta'
		        ];
		    }
		}
		
		// Codifica o resultado em JSON e envia como resposta
		echo \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	public function put() {
	    // Obter os parâmetros da requisição
	    $gerenteId = $this->getParameter('gerenteId');
	    
	    if (empty($gerenteId)) {
	        $gerenteId = $_SESSION["gerente"]["gerenteId"];
	        if (empty($gerenteId)) {
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
	    $email = $this->getParameter('email');
	    $senha = $this->getParameter('senha');
	    $nome = $this->getParameter('nome');
	    
	    // Verificar se os parâmetros necessários estão presentes
	    if (empty($codigo) || empty($email) || empty($senha) || empty($nome)) {
	        $response = [
	            'status' => false,
	            'message' => 'Todos os campos são obrigatórios'
	        ];
	        $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	        echo $json;
	        return;
	    }
	    
	    // Criptografar a senha
	    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
	    
	    // Verificar se o gerente existe com o código fornecido
	    $existingGerente = $this->gerente->listByField('codigo', $codigo);
	    
	    if (!empty($existingGerente)) {
	        // Preencher os dados do gerente
	        $this->gerente->populate($gerenteId, $codigo, $email, $senhaHash, $nome);
	        
	        // Salvar as alterações no banco de dados
	        $result = $this->gerente->save();
	        
	        if ($result) {
	            $response = [
	                'status' => true,
	                'message' => 'Alteração realizada com sucesso'
	            ];
	        } else {
	            $response = [
	                'status' => false,
	                'message' => 'Houve um erro ao alterar os dados'
	            ];
	        }
	    } else {
	        $response = [
	            'status' => false,
	            'message' => 'Gerente não encontrado'
	        ];
	    }
	    
	    // Retornar o resultado em formato JSON
	    $json = \json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	    echo $json;
	}
	

	public function delete() {		
		$codigo = $this->getParameter('codigo');
		$email = $this->getParameter('email');
		$senha = $this->getParameter('senha');
		$nome = $this->getParameter('nome');
	    $this->gerente->populate( $codigo, $email, $senha, $nome);
		$result = $this->gerente->delete();
		echo $result;
	}

	public function file(){

	}
}

new CtrlGerente();
?>