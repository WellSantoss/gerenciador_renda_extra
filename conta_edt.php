<?php
  session_start();

  if ((!isset($_SESSION['nome']) == true)) {
    session_unset();
    session_destroy();

    header('Location:./index.php');
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Conta - Gerenciador de Vendas</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/conta.css">
  </head>
  <body>
    <header>
      <div class="container">
        <h1>Editar Dados</h1>
        <div>
          <nav class="menu">
            <a href="#"><img src="./assets/menu.svg" alt="Menu"></a>
            <ul>
              <li><a href="./home.php" class="btn">Início</a></li>
              <li><a href="./produtos.php" class="btn">Produtos</a></li>
              <li><a href="./clientes.php" class="btn">Clientes</a></li>
              <li><a href="./vendas.php" class="btn">Vendas</a></li>
              <li><a href="./conta.php" class="btn">Gerenciar Conta</a></li>
              <li><a href="./index.php" class="btn">Sair</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <main>
      <form action="./app/conta/edit.php" method="POST" class="view">
        <?php
          require_once("./app/conta/view.php");
        ?>

        <input type="hidden" name="id" id="id" value="<?= $linha["id"]; ?>">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?= $linha["nome"] ?>" required>
        
        <label for="sobrenome">Sobrenome</label>
        <input type="text" name="sobrenome" id="sobrenome" value="<?= $linha["sobrenome"] ?>" required>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $linha["email"] ?>" required>

        <label for="senha">Senha (Deixe em branco caso não queira alterar)</label>
        <input type="password" name="senha" id="senha">
        
        <div>
          <a href="./conta.php" class="btn cancelar">Cancelar</a>
          <button class="salvar">Salvar Alterações</button>
        </div>
      </form>
    </main>

    <footer>
      <img src="./assets/footer-logo.svg" alt="Logo">
      <p>Gerenciador de Vendas</p>
    </footer>

    <script src="./js/script.js"></script>
  </body>
</html>