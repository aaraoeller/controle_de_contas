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
} elseif (isset($_POST['lista_contas'])) {
    $query = "SELECT * FROM V_LISTA_CONTAS";
    $viewName = "Lista geral de contas";
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
            foreach ($row as $value) {
                echo $value . " ";
            }
            echo "<br>";
        }
    }

if ($viewName === "Lista geral de contas") {
    echo "<h2>Resultado da View: " . $viewName . "</h2>";

    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Descrição</th>";
        echo "<th>Valor a Pagar</th>";
        echo "<th>Vencimento Pagamento</th>";
        echo "<th>Descrição</th>";
        echo "<th>Valor a Receber</th>";
        echo "<th>Vencimento Recebimento</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['DESCRICAO'] . "</td>";
            echo "<td>" . $row['VALOR_PAGAR'] . "</td>";
            echo "<td>" . $row['VENCIMENTO_PAGAMENTO'] . "</td>";
            echo "<td>" . $row['DESCIRCAO'] . "</td>";
            echo "<td>" . $row['VALOR_RECEBER'] . "</td>";
            echo "<td>" . $row['VENCIMENTO_RECEBIMENTO'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "A consulta não retornou resultados.";
    }
}
} else {
    echo "Erro ao executar a view: " . $mysqli->error;
}

$mysqli->close();
?>

<?php