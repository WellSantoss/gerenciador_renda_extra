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
    <title>Vendas - Gerenciador de Vendas</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/tables.css">
  </head>
  <body>
    <header>
      <div class="container">
        <h1>Vendas</h1>
        <div>
          <a href="#" class="btn" id="btn-modal">+ Nova Venda</a>
          <nav class="menu">
            <a href="#"><img src="./assets/menu.svg" alt="Menu"></a>
            <ul>
              <li><a href="./home.php" class="btn">Início</a></li>
              <li><a href="./produtos.php" class="btn">Produtos</a></li>
              <li><a href="./clientes.php" class="btn">Clientes</a></li>
              <li><a href="./vendas.php" class="btn">Vendas</a></li>
              <li><a href="./relatorio.php" class="btn">Relatório Mensal</a></li>
              <li><a href="./conta.php" class="btn">Gerenciar Conta</a></li>
              <li><a href="./index.php" class="btn">Sair</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <main>
      <div class="container">
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Produto</th>
              <th>Quant.</th>
              <th>Cliente</th>
              <th>Data</th>
              <th>Valor</th>
              <th>Data pgto.</th>
              <th>Status pgto.</th>
              <th></th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
              require_once("./app/venda/view.php");

              foreach ($result as $linha) {
            ?>

              <tr>
                <td><?= $linha["id"]; ?></td>
                <td><?= $linha["nome_produto"]; ?></td>
                <td><?= $linha["quantidade"]; ?></td>
                <td><?= $linha["nome_cliente"]; ?></td>
                <td><?= formatDate($linha["data_venda"]); ?></td>
                <td></td>
                <td><?= formatDate($linha["data_pgto"]); ?></td>
                <td><?= handleStatus($linha["status_pgto"]); ?></td>
                <td>
                  <a href="#"><img src="./assets/edit.svg" alt="Editar"></a>
                </td>
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
      
      <div class="modal">
        <form action="./app/venda/cadastro.php" method="POST">
          <h2>Cadastrar Venda</h2>

          <label for="data-venda">Data</label>
          <input type="date" name="data-venda" id="data-venda" required>
          
          <label for="produto">Produto</label>
          <select name="produto" id="produto" required>

            <?php
              require_once("./app/venda/produtos.php");

              foreach ($result as $linha) {
            ?>
              <option value="<?= $linha["id"]; ?>"><?= $linha["nome"]; ?></option>
            <?php
              }
            ?>

          </select>

          <label for="qtde">Quantidade</label>
          <input type="number" name="qtde" id="qtde" required>

          <label for="cliente">Cliente</label>
          <select name="cliente" id="cliente" required>
            
            <?php
              require_once("./app/venda/clientes.php");

              foreach ($result as $linha) {
            ?>
              <option value="<?= $linha["id"]; ?>"><?= $linha["nome"]; ?></option>
            <?php
              }
            ?>

          </select>

          <label for="status">Status de Pagamento</label>
          <select name="status" id="status" required>
            <option value="0">A pagar</option>
            <option value="1">Pago</option>
          </select>
  
          <label for="data-pgto">Data de Pagamento</label>
          <input type="date" name="data-pgto" id="data-pgto" required>
  
          <a href="#" class="btn" id="btn-cancelar">Cancelar</a>
          <button>Cadastrar</button>
        </form>
      </div>
    </main>

    <footer>
      <img src="./assets/footer-logo.svg" alt="Logo">
      <p>Gerenciador de Vendas</p>
    </footer>

    <script src="./js/script.js"></script>
  </body>
</html>