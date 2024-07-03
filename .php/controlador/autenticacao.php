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
}
?>
