<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inicia uma sessão
    session_start();

    require_once("../conexao.php");

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    try {
      $comandoSQL = $conexao -> prepare("SELECT * FROM usuarios WHERE email = :email");
      $comandoSQL -> bindParam(":email", $email);
      $comandoSQL -> execute();

      if ($comandoSQL -> rowCount() > 0) {
        $linha = $comandoSQL -> fetch();
        $hash = $linha["senha"];

        if (password_verify($senha, $hash)) {
          $_SESSION["nome"] = $linha["nome"];
          $_SESSION["id"] = $linha["id"];
          
          header("Location:../../home.php");
        }
        else {
          header("Location:../../index.php");
        }
      }
      else {
        header("Location:../../index.php");
      }
    }
    catch (PDOException $e) {
      echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
    }

    // Fecha a conexão com o banco de dados
    $conexao = null;
  }