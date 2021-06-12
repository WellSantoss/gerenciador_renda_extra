<?php
  $id_produto = filter_input(INPUT_GET, "id_produto", FILTER_SANITIZE_NUMBER_INT);
  
  require_once("./app/conexao.php");

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT * FROM produtos WHERE id_usuario = $id_usuario AND id = $id_produto";
    
    $resultado = $conexao->query($sql);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC); 
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }

  $conexao = null;