<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "contas");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Verificar qual botão foi clicado
if (isset($_POST['total_pagar'])) {
    $query = "SELECT * FROM V_TOTAL_PAGAR";
} elseif (isset($_POST['total_receber'])) {
    $query = "SELECT * FROM V_TOTAL_RECEBER";
} elseif (isset($_POST['total_geral'])) {
    $query = "SELECT * FROM V_CONTAS_TOTAL";
}

$result = $mysqli->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    echo "Resultado: " . $row['V_TOTAL_PAGAR'];
    echo "Resultado: " . $row['V_TOTAL_RECEBER'];
    echo "Resultado: " . $row['V_CONTAS_TOTAL'];
} else {
    echo "Erro ao executar a view: " . $mysqli->error;
}

$mysqli->close();
?>