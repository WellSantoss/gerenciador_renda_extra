<?php
  require_once("./app/conexao.php");

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT vendas.quantidade, produtos.valor FROM vendas, produtos WHERE vendas.id_usuario = $id_usuario AND vendas.id_produto = produtos.id AND vendas.status_pgto = 0";

    $select = $conexao -> query($sql);
    $result = $select -> fetchAll();
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }

  function calcNum2($qtde, $valor) {    
    return $qtde * $valor;
  }