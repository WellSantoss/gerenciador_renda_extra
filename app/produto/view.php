<?php
  require_once("../conexao.php");

  session_start();

  if ((!isset($_SESSION['nome']) == true)) {
    session_unset();
    session_destroy();

    header('Location:./index.php');
  }

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT id, nome, valor FROM produtos WHERE id_usuario = $id_usuario";
    $select = $conexao -> query($sql);
    $result = $select -> fetchAll();
    
    // echo "<pre>";
    // print_r($result);
    // echo "<pre>";
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }