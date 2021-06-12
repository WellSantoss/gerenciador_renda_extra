<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id_produto", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id_produto = filter_input(INPUT_POST, "id_produto", FILTER_SANITIZE_NUMBER_INT);

    try {
      $comandoSQL = $conexao -> prepare("UPDATE produtos SET active = false WHERE id = :id");
      $comandoSQL -> bindParam(':id', $id_produto);
      $comandoSQL -> execute();

      if ($comandoSQL -> rowCount() > 0){
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