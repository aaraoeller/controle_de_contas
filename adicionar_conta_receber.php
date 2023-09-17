<?php
$descricao_receber = $_POST['descricao_receber'];
$valor_receber = $_POST['valor_receber'];
$data_venc_receber = $_POST['data_venc_receber'];

// Conecte-se ao seu banco de dados e chame a procedure P_INS_CONTAS_RECEBER
// Execute a inserção de dados aqui

header("Location: index.html"); // Redirecione para a página principal
?>