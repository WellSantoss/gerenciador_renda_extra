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
    <title>Produtos - Gerenciador de Vendas</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/tables.css">
  </head>
  <body>
    <header>
      <div class="container">
        <h1>Produtos</h1>
        <div>
          <a href="#" class="btn" id="btn-modal">+ Novo Produto</a>
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

    <main class="produtos">
      <div class="container">
        <table>
          <thead>
            <tr>
              <th class="invisible">id</th>
              <th>Nome</th>
              <th>Valor</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
              require_once("./app/produto/view.php");

              foreach ($result as $linha) {
            ?>

              <tr>
                <td class="invisible"><?= $linha["id"]; ?></td>
                <td><?= $linha["nome"]; ?></td>
                <td><?= str_replace('.', ',', $linha["valor"]); ?></td>
                <td>
                  <a href="#"><img src="./assets/delete.svg" alt="Deletar"></a>
                </td>
              </tr>

            <?php
              }
            ?>

          </tbody>
        </table>
      </div>
      
      <div class="modal del active">
        <form action="./app/produto/delete.php" method="POST">
          <?php
            require_once("./app/produto/view_del.php");
          ?>

          <h2>Cadastrar Produto</h2>

          <input type="hidden" name="id_produto" id="id_produto" value="<?= $id_produto ?>">

          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" value="<?= $linha["nome"]; ?>" disabled>

          <label for="valor">Valor</label>
          <input type="number" name="valor" id="valor" value="<?= $linha["valor"]; ?>" disabled>
  
          <a href="./produtos.php" class="btn" id="btn-cancelar">Cancelar</a>
          <button>Excluir</button>
        </form>
      </div>
    </main>

    <footer>
      <img src="./assets/footer-logo.svg" alt="Logo">
      <p>Gerenciador de Vendas</p>
    </footer>
  </body>
</html>