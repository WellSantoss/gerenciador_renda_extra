<?php
  require_once("./app/conexao.php");

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
    
    $resultado = $conexao->query($sql);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC); 
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }