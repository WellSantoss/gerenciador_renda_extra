<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    try {
      $sql = $conexao -> prepare("DELETE FROM vendas WHERE id_usuario = :id; DELETE FROM produtos WHERE id_usuario = :id; DELETE FROM clientes WHERE id_usuario = :id; DELETE FROM usuarios WHERE id = :id;");

      $sql -> bindParam(':id', $id);
      $sql -> execute();

      if ($sql -> rowCount() > 0){
        header("Location:../../index.php");
      }
      else {
        echo "Erro na exclusão!";
      }
    }
    catch (PDOException $e) {
      echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
    }
  }