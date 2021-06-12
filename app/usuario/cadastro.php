<?php
  $name      = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
  $sobrenome = filter_input(INPUT_POST, "sobrenome", FILTER_SANITIZE_STRING);
  $email     = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $senha     = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

  require_once("../conexao.php");

  try {
    $sql = $conexao -> prepare("INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (:nome, :sobrenome, :email, :senha)");

    $sql -> execute(array(
      ':nome'  => $name,
      ':sobrenome' => $sobrenome,
      ':email' => $email,
      ':senha' => password_hash($senha, PASSWORD_DEFAULT)
    ));

    if ($sql -> rowCount() > 0) {
      header('Location:../../home.php');
    } else {
      echo "ERRO.";
    }

  } catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }

  $conexao = null; // Fecha a conexão