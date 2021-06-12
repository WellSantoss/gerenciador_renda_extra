<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inicia uma sessão
    session_start();

    require_once("../conexao.php");

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    try {
      $sql = $conexao -> prepare("SELECT * FROM usuarios WHERE email = :email");
      $sql -> bindParam(":email", $email);
      $sql -> execute();

      if ($sql -> rowCount() > 0) {
        $linha = $sql -> fetch();
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