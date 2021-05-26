<?php
  session_start();

  $usuario   = $_SESSION['id'];
  $dataVenda = filter_input(INPUT_POST, "data-venda", FILTER_SANITIZE_STRING);
  $produto   = filter_input(INPUT_POST, "produto", FILTER_SANITIZE_NUMBER_INT);
  $qtde      = filter_input(INPUT_POST, "qtde", FILTER_SANITIZE_NUMBER_INT);
  $cliente   = filter_input(INPUT_POST, "cliente", FILTER_SANITIZE_NUMBER_INT);
  $status    = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT);
  $dataPgto  = filter_input(INPUT_POST, "data-pgto", FILTER_SANITIZE_NUMBER_INT);

  require_once("../conexao.php");

  try {
    $comandoSQL = $conexao -> prepare("INSERT INTO vendas (id_usuario, id_cliente, id_produto, data_venda, quantidade, status_pgto, data_pgto) VALUES (:usuario, :cliente, :produto, :dataVenda, :qtde, :statusPgto, :dataPgto)");

    $comandoSQL -> execute(array(
      ':usuario'    => $usuario,
      ':cliente'    => $cliente,
      ':produto'    => $produto,
      ':dataVenda'  => $dataVenda,
      ':qtde'       => $qtde,
      ':statusPgto' => $status,
      ':dataPgto'   => $dataPgto      
    ));

    if ($comandoSQL -> rowCount() > 0) {
      header('Location:../../vendas.php');
    } else {
      echo "ERRO.";
    }

  } catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }

  $conexao = null;