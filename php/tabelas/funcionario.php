<?php
    class funcionario {
        private $conn;
        private $codigo;
        private $nome;
        private $email;
        private $fk_unidade;
        private $senha;

        function __construct($conn){
            $this->conn = $conn;
        }
        public function getCodigo()
        {
            return $this->codigo;
        }
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }
        public function getNome()
        {
            return $this->nome;
        }
        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getFk_unidade()
        {
            return $this->fk_unidade;
        }
        public function setFk_unidade($fk_unidade)
        {
            $this->fk_unidade = $fk_unidade;
        }

        public function getSenha()
        {
            return $this->senha;
        }
        public function setSenha($senha)
        {
            $this->senha = $senha;
        }
        function cadastrarFun($codigo, $nome, $email, $fk_unidade, $senha) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO funcionario (codigo, nome, email, fk_unidade, senha) VALUES 
                (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssis", $codigo, $nome, $email, $fk_unidade, $senhaHash);
            
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>