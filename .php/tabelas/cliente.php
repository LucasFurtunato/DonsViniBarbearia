<?php
    class cliente{
        private $conn;
        private $nome;
        private $email;
        private $senha;
        private $token;
        private $emailVerified;

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
        function get_token(){
            return $this->token;
        }
        function set_token($token){
            $this->token = $token;
        }
        function get_emailVerified(){
            return $this->emailVerified;
        }
        function set_emailVerified($emailVerified){
            $this->emailVerified = $emailVerified;
        }

        function cadastrar($nome, $email, $senha, $token, $emailVerified) {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(10));
            $sql = "INSERT INTO cliente (nome, email, senha, token, email_verified) VALUES 
                (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $nome, $email, $senhaHash, $token, $emailVerified);
            
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
?>