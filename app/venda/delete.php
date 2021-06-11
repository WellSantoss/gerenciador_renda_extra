<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id_venda", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id_venda = filter_input(INPUT_POST, "id_venda", FILTER_SANITIZE_NUMBER_INT);

    try {
      $comandoSQL = $conexao -> prepare("DELETE FROM vendas WHERE id=:id");
      $comandoSQL -> bindParam(':id', $id_venda);
      $comandoSQL -> execute();

      if ($comandoSQL -> rowCount() > 0){
        header("Location:../../vendas.php");
      }
      else {
        echo "Erro na exclusão!";
      }
    }
    catch (PDOException $e) {
      echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
    }
  }