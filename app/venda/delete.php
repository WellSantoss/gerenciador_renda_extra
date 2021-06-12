<?php
  require_once("../conexao.php");

  if (!filter_input(INPUT_POST, "id_venda", FILTER_SANITIZE_NUMBER_INT)) {
    echo "ID inválido";
  }
  else {
     $id_venda = filter_input(INPUT_POST, "id_venda", FILTER_SANITIZE_NUMBER_INT);

    try {
      $sql = $conexao -> prepare("DELETE FROM vendas WHERE id=:id");
      $sql -> bindParam(':id', $id_venda);
      $sql -> execute();

      if ($sql -> rowCount() > 0){
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