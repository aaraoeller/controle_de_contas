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
    echo "Resultado: " . $viewName . "<br>";
    
    // Verifica se há resultados da consulta
    if ($result->num_rows > 0) {
        // Itera pelos resultados e os exibe
        while ($row = $result->fetch_assoc()) {
            // Exiba os resultados de todas as colunas
            foreach ($row = $value) {
                echo $value;
            }
            echo "<br>";
        }
    } else {
        echo "A consulta não retornou resultados.";
    }
} else {
    echo "Erro ao executar a view: " . $mysqli->error;
}

$mysqli->close();
?>
