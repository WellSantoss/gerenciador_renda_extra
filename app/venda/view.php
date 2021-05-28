<?php
  require_once("./app/conexao.php");

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT vendas.id, clientes.nome AS 'nome_cliente', produtos.nome AS 'nome_produto', produtos.valor, vendas.data_venda, vendas.quantidade, vendas.status_pgto, vendas.data_pgto FROM vendas, clientes, produtos WHERE vendas.id_cliente = clientes.id AND vendas.id_produto = produtos.id";

    $select = $conexao -> query($sql);
    $result = $select -> fetchAll();
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }

  function handleStatus($status) {
    if ($status == 0) {
      return "A pagar";
    }
    else {
      return "Pago";
    }
  }

  function formatDate($date) {
    return date('d/m/Y', strtotime($date));
  }

  function calcValor($qtde, $valor) {
    $result = $qtde * $valor;
    return "R$ " . number_format($result, 2);
  }