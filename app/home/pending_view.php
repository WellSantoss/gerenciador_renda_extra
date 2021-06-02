<?php
  require_once("./app/conexao.php");

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT vendas.id, vendas.data_pgto, vendas.quantidade, clientes.nome AS 'nome_cliente', produtos.valor FROM vendas, clientes, produtos WHERE vendas.id_usuario = $id_usuario AND vendas.id_cliente = clientes.id AND vendas.id_produto = produtos.id AND vendas.status_pgto = 0 ORDER BY vendas.data_pgto LIMIT 5";

    $select = $conexao -> query($sql);
    $result = $select -> fetchAll();
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }
