<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id_cliente", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id_cliente = filter_input(INPUT_POST, "id_cliente", FILTER_SANITIZE_NUMBER_INT);

    try {
      $sql = $conexao -> prepare("UPDATE clientes SET active = false WHERE id = :id");
      $sql -> bindParam(':id', $id_cliente);
      $sql -> execute();

      if ($sql -> rowCount() > 0){
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