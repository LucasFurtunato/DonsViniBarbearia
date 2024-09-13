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
            if (password_verify($senha, $cliente['SENHA'])) {
                return $cliente;
            }
        }
        return false;  
    }

    public function verificarGerente($codigo, $email, $senha, $confirmarsenha) {
        $query = "SELECT * FROM gerente WHERE codigo = ?";
        $query1 = "SELECT * FROM gerente WHERE email = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt1 = $this->conexao->prepare($query1);
        $stmt->bind_param("s", $codigo);
        $stmt1->bind_param("s", $email);
        $stmt->execute();
        $stmt1->execute();
        $result = $stmt->get_result();
        $result = $stmt1->get_result();
        if ($result->num_rows === 1) {
            $gerente = $result->fetch_assoc();
            if (password_verify($senha, $gerente['SENHA'])) {
                return $gerente;
            }
        }
        return false;  
    }
}
?>
