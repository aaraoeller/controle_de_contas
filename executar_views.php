<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "contas");

// Verificação de erros na conexão
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
} elseif (isset($_POST['lista_contas'])) {
    $query = "SELECT * FROM V_LISTA_CONTAS";
    $viewName = "Lista geral de contas";
}

// execução da consulta SQL
$result = $mysqli->query($query);

if ($result) {
    // Exibe o resultado da View selecionada
    echo "Resultado: " . $viewName . "<br>";
    
    // Verifica se há resultados da consulta
    if ($result->num_rows > 0) {
        // Itera pelos resultados e os exibe
        while ($row = $result->fetch_assoc()) {
            // Exibe os resultados de todas as colunas
            foreach ($row as $value) {
                echo $value;
            }
            echo "<br>";
        }

        while ($row = $result->fetch_assoc()) {
            // Exibe os resultados em uma tabela para melhor formatação
            echo "<tr class='tipo-" . strtolower($row['Tipo']) . "'>";
            echo "<td>" . $row['Tipo'] . "</td>";
            echo "<td>" . $row['DESCRICAO'] . "</td>";
            echo "<td>" . $row['VALOR'] . "</td>";
            echo "<td>" . $row['VENCIMENTO'] . "</td>";
            echo "</tr>";
        }
        

    } else {
        echo "A consulta não retornou resultados.";
    }
} else {
    echo "Erro ao executar a view: " . $mysqli->error;
}

// Fechamento da conexão com o Banco de Dados
$mysqli->close();
?>