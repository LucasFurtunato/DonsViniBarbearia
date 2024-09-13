<?php
    class cliente{
        private $conn;
        private $nome;
        private $email;
        private $senha;

        function __construct($conn){
            $this->conn = $conn;
            
        }
        function get_nome(){
            return $this->nome;
        }
        function set_nome($nome){
            $this->nome = $nome; 
        }
        function get_email(){
            return $this->email;
        }
        function set_email($email){
            $this->email = $email;
        }
        function get_senha(){
            return $this->senha;
        }
        function set_senha($senha){
            $this->senha = $senha;
        }
        function get_codigo(){
            return $this->codigo;
        }
        function set_codigo($codigo){
            $this->codigo = $codigo;
        }
    }
?>