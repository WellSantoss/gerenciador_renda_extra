<?php
  $id_venda = filter_input(INPUT_GET, "id_venda", FILTER_SANITIZE_NUMBER_INT);

  require_once("./app/conexao.php");

  try {
    $comandoSQL = "SELECT vendas.id_cliente, vendas.id_produto, vendas.data_venda, vendas.quantidade, vendas.status_pgto, vendas.data_pgto, produtos.nome AS 'nome_produto', clientes.nome AS 'nome_cliente' FROM vendas, clientes, produtos WHERE vendas.id = $id_venda AND vendas.id_cliente = clientes.id AND vendas.id_produto = produtos.id";

    $resultado = $conexao->query($comandoSQL);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC); 
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }

  $conexao = null;