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
    <title>Gerenciador de Vendas</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
  </head>
  <body>
    <header>
      <div class="container">
        <h1>Olá, <?= $_SESSION['nome'] ?>!</h1>
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
        <section class="cards">
          <div class="card">
            <h3>Receitas</h3>
            <div>
              <p>
                <?php
                  require_once("./app/home/incomes.php");

                  $resultado = 0;

                  foreach ($result as $linha) {
                    $resultado += calcNum1($linha["quantidade"], $linha["valor"]);
                  }

                  echo "R$ " . str_replace('.', ',', number_format($resultado, 2));
                ?>
              </p>
              
              <a href="./vendas.php?filtro=1"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
          </div>
  
          <div class="card">
            <h3>Receitas Pendentes</h3>
            <div>
              <p>
                <?php
                  require_once("./app/home/pending_incomes.php");

                  $resultado = 0;

                  foreach ($result as $linha) {
                    $resultado += calcNum2($linha["quantidade"], $linha["valor"]);
                  }

                  echo "R$ " . str_replace('.', ',', number_format($resultado, 2));
                ?>
              </p>
              <a href="./vendas.php?filtro=2"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
          </div>
  
          <div class="card">
            <h3>Total de Receitas Previstas</h3>
            <div>
              <p>
                <?php
                  require_once("./app/home/total.php");

                  $resultado = 0;

                  foreach ($result as $linha) {
                    $resultado += calcNum($linha["quantidade"], $linha["valor"]);
                  }

                  echo "R$ " . str_replace('.', ',', number_format($resultado, 2));
                ?>
              </p>
              <a href="./vendas.php"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
          </div>
        </section>
  
        <section class="tables">
          <div class="ultimas">
            <div class="sub-tittle">
              <h2>Últimas Vendas</h2>
              <a href="./vendas.php"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
            <table>
              <thead>
                <tr>
                  <th class="invisible">ID</th>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>Cliente</th>
                  <th>Data</th>
                  <th>Valor</th>
                </tr>
              </thead>
  
              <tbody>

                <?php
                  require_once("./app/home/last_view.php");

                  foreach ($result as $linha) {
                ?>

                  <tr>
                    <td class="invisible"><?= $linha["id"]; ?></td>
                    <td><?= $linha["nome_produto"]; ?></td>
                    <td><?= $linha["quantidade"]; ?></td>
                    <td><?= $linha["nome_cliente"]; ?></td>
                    <td><?= formatDate($linha["data_venda"]); ?></td>
                    <td><?= calcValor($linha["quantidade"], $linha["valor"]); ?></td>
                  </tr>

                <?php
                  }
                ?>

              </tbody>
            </table>
          </div>
          
          <div class="pendentes">
            <div class="sub-tittle">
              <h2>Vendas Pendentes</h2>
              <a href="./vendas.php?filtro=2"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
            <table>
              <thead>
                <tr>
                  <th class="invisible">ID</th>
                  <th>Cliente</th>
                  <th>Valor</th>
                  <th>Data pgto.</th>
                </tr>
              </thead>
  
              <tbody>

                <?php
                  require_once("./app/home/pending_view.php");

                  foreach ($result as $linha) {
                ?>

                  <tr>
                    <td class="invisible"><?= $linha["id"]; ?></td>
                    <td><?= $linha["nome_cliente"]; ?></td>
                    <td><?= calcValor($linha["quantidade"], $linha["valor"]); ?></td>
                    <td><?= formatDate($linha["data_pgto"]); ?></td>
                  </tr>

                <?php
                  }
                ?>

              </tbody>
            </table>
          </div>
        </section>
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