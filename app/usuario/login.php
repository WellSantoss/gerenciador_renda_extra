<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inicia uma sessão
    session_start();

    require_once("../conexao.php");

    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    try {
      $comandoSQL = $conexao -> prepare("SELECT * FROM usuarios WHERE email_user = :email");
      $comandoSQL -> bindParam(":email", $email);
      $comandoSQL -> execute();

      if ($comandoSQL -> rowCount() > 0) {
        $linha = $comandoSQL -> fetch();
        $hash = $linha["senha_user"];

        if (password_verify($senha, $hash)) {
          $_SESSION["nome"] = $linha["nome_user"];
          
          // Direciona para view_login.php
          header("Location:../../home.php");
        }
        else {
          // Direciona para index.php
          header("Location:../../index.php");
        }
      }
      else {
        // Direciona para index.php
        header("Location:../../index.php");
      }
    }
    // Se não conseguir
    catch (PDOException $e) {
      // Exibe o erro
      echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
    }

    // Fecha a conexão com o banco de dados
    $conexao = null;
  }