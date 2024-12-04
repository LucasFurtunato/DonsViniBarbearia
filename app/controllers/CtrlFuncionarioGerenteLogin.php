<?php



namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Funcionario;
use app\models\Agendamentos;
use app\models\Gerente;



require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlFuncionarioGerenteLogin extends ControllerHandler {

	private $funcionario = null;
	private $gerente = null;
	
	public function __construct(){
		$this->funcionario = new Funcionario();
		$this->gerente = new Gerente();
		parent::__construct();
	}

	public function get() {
	    
	}

	public function post() {		
		$codigo = $this->getParameter('codigo');
		$email = $this->getParameter('email');
		$senhaFuncionario = $this->getParameter('senha');
		
		$existingGerente = $this->gerente->listByfield('email', $email);
		
		if (!empty($existingGerente) && $email === $existingGerente[0]['email']) {
		    $gerenteId = $existingGerente[0]['gerenteId'];
		    $nome = $existingGerente[0]['nome'];
		    $storedHash = $existingGerente[0]['senha'];
		    
		    if (password_verify($senhaFuncionario, $storedHash)){ 
		        $_SESSION["gerente"]["gerenteId"] = $gerenteId;
		        $_SESSION["gerente"]["codigo"] = $codigo;
		        $_SESSION["gerente"]["nome"] = $nome;
		        $_SESSION["gerente"]["email"] = $email;
		        
		        $result = [
		            'status' => true,
		            'tipo' => 'gerente',
		            'message' => 'Login Executado'
		        ];
		    } else {
		        $result = [
		            'status' => false,
		            'message' => 'Código, email ou senha incorreta'
		        ];
		    }
		    
		    $json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		    echo $json;
		    return;
		}
		
		$existingFuncionario = $this->funcionario->listByfield('email', $email);
		
    	if (!empty($existingFuncionario)) {
    	    $funcionarioId = $existingFuncionario[0]['funcionarioId'];
    	    $nome = $existingFuncionario[0]['nome'];
    	    $unidadeId = $existingFuncionario[0]['unidadeId'];
    	    $storedHash = $existingFuncionario[0]['senha'];
 
    	    if (password_verify($senhaFuncionario, $storedHash)){
    	        $_SESSION["funcionario"]["funcionarioId"] = $funcionarioId;
    	        $_SESSION["funcionario"]["codigo"] = $codigo;
    	        $_SESSION["funcionario"]["nome"] = $nome;
    	        $_SESSION["funcionario"]["email"] = $email;
    	        $_SESSION["funcionario"]["unidadeId"] = $unidadeId;
    			
    			$result = [
    				'status' => true,
    			    'tipo' => 'funcionario',
    				'message' => 'Login Executado'
    			];
    		} else {
    			$result = [
    				'status' => false,
    				'message' => 'Código, email ou senha incorreta'
    			];
    		}
    	} else {
    	    $result = [
    	        'status' => false,
    	        'message' => 'Este Funcionario não existe'
    	    ];
    	}
    	
    	$json = \json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    	echo $json;
	} 

	public function put() {		
	}

	public function delete() {
    
    }
		
}



new CtrlFuncionarioGerenteLogin();
?>