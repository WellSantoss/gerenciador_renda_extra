<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id_produto", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id_produto = filter_input(INPUT_POST, "id_produto", FILTER_SANITIZE_NUMBER_INT);

    try {
      $sql = $conexao -> prepare("UPDATE produtos SET active = false WHERE id = :id");
      $sql -> bindParam(':id', $id_produto);
      $sql -> execute();

      if ($sql -> rowCount() > 0){
        header("Location:../../produtos.php");
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