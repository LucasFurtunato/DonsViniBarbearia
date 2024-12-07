<?php

namespace app\controllers;

use app\core\ControllerHandler;
use app\models\Galeria;



require_once  dirname( __DIR__ , 1).'/config.php';

class CtrlGaleria extends ControllerHandler {

	private $galeria = null;

	public function __construct(){
		$this->galeria = new Galeria();
		parent::__construct();
	}

	public function get() {
		$data = $this->galeria->listAll();
		$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo $json;
	}

	public function post() {

		if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

			$fileTmpPath = $_FILES['image']['tmp_name'];
			$fileName = $_FILES['image']['name'];
			$fileSize = $_FILES['image']['size'];
			$fileType = $_FILES['image']['type'];
	
			$uploadDir = '../uploads/gallery/'; 
			$destPath = $uploadDir . basename($fileName);

			!is_dir($uploadDir) ? mkdir($uploadDir, 0770, true) : chmod($uploadDir, 0770);
					
			if (move_uploaded_file($fileTmpPath, $destPath)) {

				$imagem = str_replace('../', '', $destPath);
				
				$galeriaId = 0;  
				$localizacao = 0; 
	
				$this->galeria->populate($galeriaId, $localizacao, $imagem);

				$result = $this->galeria->save();
	
				if ($result) {
					echo json_encode(["success" => true, "message" => "Imagem carregada e salva com sucesso.", "imagePath" => $imagem]);
				} else {
					echo json_encode(["success" => false, "message" => "Erro ao salvar os dados no banco."]);
				}
			} else {
				echo json_encode(["success" => false, "message" => "Erro ao mover o arquivo para o diretório de uploads."]);
			}
		} else {
			echo json_encode(["success" => false, "message" => "Nenhuma imagem foi enviada ou ocorreu um erro no upload."]);
		}
	}
	

	public function put() {		
		$galeriaId = $this->getParameter('galeriaId');
		$localizacao = $this->getParameter('localizacao');
		$imagem = $this->getParameter('imagem');
	    $this->galeria->populate( $galeriaId, $localizacao, $imagem);
		$result = $this->galeria->save();
		echo $result;
	}

	public function delete() {		
		$galeriaId = $this->getParameter('id'); 

		if (empty($galeriaId)) {
			echo json_encode(["message" => "ID da imagem não fornecido."]);
			return;
		}

		$this->galeria->populate($galeriaId, '', ''); 
	
		$result = $this->galeria->delete();
	
		if ($result) {
			echo json_encode(["message" => "Imagem removida com sucesso.", "status" => 200]);
		} else {
			echo json_encode(["message" => "Erro ao remover a imagem."]);
		}
	}
	

	public function file(){

	}
}

new CtrlGaleria();
?>