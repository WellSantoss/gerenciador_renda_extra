<?php
  session_start();
  session_unset();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gerenciador de Vendas</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
  </head>
  <body>
    <header>
      <img src="./assets/header-logo.svg" alt="Logo" />
      <h1>Gerenciador de Vendas</h1>
    </header>

    <main>
      <p>Gerencie seu pequeno empreendimento de forma simplificada.</p>

      <form action="./app/usuario/login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">

        <button>Entrar</button>

        <p>Não tem uma conta? <a href="./register.html">Registre-se</a></p>
      </form>
    </main>
  </body>
</html>