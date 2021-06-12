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
              <th class="invisible">Id</th>
              <th>Produto</th>
              <th>Quant.</th>
              <th>Cliente</th>
              <th>Data</th>
              <th>Valor</th>
              <th>Data pgto.</th>
              <th>Status pgto.</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
              require_once("./app/venda/view.php");

              foreach ($result as $linha) {
            ?>

              <tr>
                <td class="invisible"><?= $linha["id"]; ?></td>
                <td><?= $linha["nome_produto"]; ?></td>
                <td><?= $linha["quantidade"]; ?></td>
                <td><?= $linha["nome_cliente"]; ?></td>
                <td><?= formatDate($linha["data_venda"]); ?></td>
                <td><?= calcValor($linha["quantidade"], $linha["valor"]); ?></td>
                <td><?= formatDate($linha["data_pgto"]); ?></td>
                <td><?= handleStatus($linha["status_pgto"]); ?></td>
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
        <form action="./app/venda/delete.php" method="POST">
          <?php
            require_once("./app/venda/view_del.php");
          ?>
              
          <h2>Excluir Venda</h2>

          <input type="hidden" name="id_venda" id="id_venda" value="<?= $id_venda; ?>">

          <label for="data-venda">Data</label>
          <input type="date" name="data-venda" id="data-venda" value="<?= $linha["data_venda"]; ?>"disabled>
          
          <label for="produto">Produto</label>
          <input type="text" name="produto" id="produto" value="<?= $linha["nome_produto"]; ?>"disabled>
          

          <label for="qtde">Quantidade</label>
          <input type="number" name="qtde" id="qtde" value="<?= $linha["quantidade"]; ?>" disabled>

          <label for="cliente">Cliente</label>
          <input type="text" name="cliente" id="cliente" value="<?= $linha["nome_cliente"]; ?>"disabled>

          <label for="status">Status de Pagamento</label>
          <input type="text" name="status" id="status" value="<?= $linha["status_pgto"] == 1 ? "Pago" : "A Pagar"; ?>"disabled>
  
          <label for="data-pgto">Data de Pagamento</label>
          <input type="date" name="data-pgto" id="data-pgto" value="<?= $linha["data_pgto"]; ?>" disabled>
  
          <a href="./vendas.php" class="btn" id="btn-cancelar">Cancelar</a>
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