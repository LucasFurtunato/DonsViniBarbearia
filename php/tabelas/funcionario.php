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
            return $this;
        }
        public function getNome()
        {
            return $this->nome;
        }
        public function setNome($nome)
        {
            $this->nome = $nome;
            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
            return $this;
        }

        public function getFk_unidade()
        {
            return $this->fk_unidade;
        }
        public function setFk_unidade($fk_unidade)
        {
            $this->fk_unidade = $fk_unidade;
            return $this;
        }

        public function getSenha()
        {
            return $this->senha;
        }
        public function setSenha($senha)
        {
            $this->senha = $senha;
            return $this;
        }
    }


?>