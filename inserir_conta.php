<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "contas");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Recuperar dados do formulário
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];
$tipo = $_POST['tipo'];

// Inserir dados de acordo com o tipo (pagar ou receber)
if ($tipo === 'pagar') {
    $query = "CALL P_INS_CONTAS_PAGAR('$descricao', $valor, '$data')";
} else {
    $query = "CALL P_INS_CONTAS_RECEBER('$descricao', $valor, '$data')";
}

if ($mysqli->query($query)) {
    echo "Conta inserida com sucesso!";
} else {
    echo "Erro ao inserir conta: " . $mysqli->error;
}

$mysqli->close();
?>