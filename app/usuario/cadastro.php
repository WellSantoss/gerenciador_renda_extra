<?php
  $name      = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
  $sobrenome = filter_input(INPUT_POST, "txtSobrenome", FILTER_SANITIZE_STRING);
  $email     = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
  $senha     = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING);

  require_once("../conexao.php");

  try {
    $comandoSQL = $conexao -> prepare("INSERT INTO usuarios (nome_user, sobrenome_user, email_user, senha_user) VALUES (:nome, :sobrenome, :email, :senha)");

    $comandoSQL -> execute(array(
      ':nome'  => $name,
      ':sobrenome' => $sobrenome,
      ':email' => $email,
      ':senha' => password_hash($senha, PASSWORD_DEFAULT)
    ));

    if ($comandoSQL -> rowCount() > 0) {
      header('Location:../../home.php');
    } else {
      echo "ERRO.";
    }

  } catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }

  $conexao = null; // Fecha a conexão