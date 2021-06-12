<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id_cliente", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id_cliente = filter_input(INPUT_POST, "id_cliente", FILTER_SANITIZE_NUMBER_INT);

    try {
      $comandoSQL = $conexao -> prepare("UPDATE clientes SET active = false WHERE id = :id");
      $comandoSQL -> bindParam(':id', $id_cliente);
      $comandoSQL -> execute();

      if ($comandoSQL -> rowCount() > 0){
        header("Location:../../clientes.php");
      }
      else {
        echo "Erro na exclusão!";
      }
    }
    catch (PDOException $e) {
      echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
    }
  }

  $conexao = null;