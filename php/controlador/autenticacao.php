<?php
class autenticacao {
    private $conexao;
    public function __construct($conexao) {
        $this->conexao = $conexao;        
    }
    public function verificarCliente($email, $senha) {
        $query = "SELECT * FROM cliente WHERE email = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $cliente = $result->fetch_assoc();
            if ($cliente['email_verified'] == 0) {
                return false;
            }
            else if (password_verify($senha, $cliente['senha'])) {
                return $cliente;
            }
        }
        return false;  
    }

    public function verificarGerente($codigo, $email, $senha, $confirmarsenha) {
        $query = "SELECT * FROM gerente WHERE CODIGO = ? AND EMAIL = ? AND SENHA = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bind_param("sss", $codigo, $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            if ($senha === $confirmarsenha){
                $gerente = $result->fetch_assoc();
                return $gerente;
            }
        }
        return false;  
    }
}
?>
