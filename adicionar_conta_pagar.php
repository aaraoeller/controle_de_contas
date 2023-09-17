<?php
$descricao_pagar = $_POST['descricao_pagar'];
$valor_pagar = $_POST['valor_pagar'];
$data_venc_pagar = $_POST['data_venc_pagar'];

// Conecte-se ao seu banco de dados e chame a procedure P_INS_CONTAS_PAGAR
// Execute a inserção de dados aqui

header("Location: index.html"); // Redirecione para a página principal
?>