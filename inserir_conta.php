<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "contas");

// Verificação de erros na conexão
if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Recuperar dados do formulário
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];
$tipo = $_POST['tipo'];

// Inserir dados de acordo com o tipo (contas a pagar ou contas a receber)
if ($tipo === 'pagar') {
    $query = "CALL P_INS_CONTAS_PAGAR('$descricao', $valor, '$data')";
} else {
    $query = "CALL P_INS_CONTAS_RECEBER('$descricao', $valor, '$data')";
}

// Execução da consulta SQL
if ($mysqli->query($query)) {
    echo "<script>exibirMensagem('Conta inserida com sucesso!');</script>";
}

} else {
    echo "Erro ao inserir conta: " . $mysqli->error;
}

// Fechamento da conexão com o Banco de Dados
$mysqli->close();
?>