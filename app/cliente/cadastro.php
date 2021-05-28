<?php
  session_start();

  $usuario = $_SESSION['id'];
  $nome    = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
  $fone    = filter_input(INPUT_POST, "fone", FILTER_SANITIZE_STRING);
  $obs     = filter_input(INPUT_POST, "obs", FILTER_SANITIZE_STRING);

  require_once("../conexao.php");

  try {
    $comandoSQL = $conexao -> prepare("INSERT INTO clientes (id_usuario, nome, telefone, obs) VALUES (:usuario, :nome, :fone, :obs)");

    $comandoSQL -> execute(array(
      ':usuario' => $usuario,
      ':nome'    => $nome,
      ':fone'    => $fone,
      ':obs'     => $obs
    ));

    if ($comandoSQL -> rowCount() > 0) {
      header('Location:../../clientes.php');
    } else {
      echo "ERRO.";
    }

  } catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }

  $conexao = null;