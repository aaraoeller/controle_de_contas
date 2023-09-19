<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "contas");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Verificar qual botão foi clicado
if (isset($_POST['total_pagar'])) {
    $query = "SELECT * FROM V_TOTAL_PAGAR";
    $viewName = "Total a Pagar";
} elseif (isset($_POST['total_receber'])) {
    $query = "SELECT * FROM V_TOTAL_RECEBER";
    $viewName = "Total a Receber";
} elseif (isset($_POST['total_geral'])) {
    $query = "SELECT * FROM V_CONTAS_TOTAL";
    $viewName = "Total Geral";
}

$result = $mysqli->query($query);

if ($result) {
    // Exibe o nome da view
    echo "Resultado da View: " . $query . "<br>";
    
    // Processa os resultados da consulta
    while ($row = $result->fetch_assoc()) {
        // Aqui você pode acessar os resultados da consulta específica
        // Exemplo: echo "Descrição: " . $row['DESCRICAO'] . "<br>";
        // Lembre-se de usar os nomes das colunas das views corretamente
    }
} else {
    echo "Erro ao executar a view: " . $mysqli->error;
}

$mysqli->close();
?>