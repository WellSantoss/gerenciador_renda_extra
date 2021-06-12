<?php
  require_once("../conexao.php");

  $nome      = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
  $sobrenome = filter_input(INPUT_POST, "sobrenome", FILTER_SANITIZE_STRING);
  $email     = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $senha     = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
  $id        = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

  try {
    if ($senha == "") {
      $comandoSQL = $conexao -> prepare("UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, email = :email WHERE id = :id");

      $comandoSQL -> execute(array(
        ':nome'      => $nome,
        ':sobrenome' => $sobrenome,
        ':email'     => $email,
        ':id'        => $id
      ));
    }
    else {
      $comandoSQL = $conexao -> prepare("UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha WHERE id = :id");

      $comandoSQL -> execute(array(
        ':nome'      => $nome,
        ':sobrenome' => $sobrenome,
        ':email'     => $email,
        ':senha'     => password_hash($senha, PASSWORD_DEFAULT),
        ':id'        => $id
      ));
    }

    if ($comandoSQL -> rowCount() > 0){
      header("Location:../../index.php");
    }
    else {
      echo "Erro na atualização";
    }

  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }

  $conexao = null;