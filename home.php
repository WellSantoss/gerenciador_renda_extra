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
              <p>R$ 264,65</p>
              <a href="#"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
          </div>
  
          <div class="card">
            <h3>Receitas Pendentes</h3>
            <div>
              <p>R$ 64,65</p>
              <a href="#"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
          </div>
  
          <div class="card">
            <h3>Total de Receitas Previstas</h3>
            <div>
              <p>R$ 329,30</p>
              <a href="#"><img src="./assets/arrow.svg" alt="Seta"></a>
            </div>
          </div>
        </section>
  
        <section class="tables">
          <div class="ultimas">
            <h2>Últimas Vendas</h2>
            <table>
              <thead>
                <tr>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>Cliente</th>
                  <th>Data</th>
                  <th>Valor</th>
                </tr>
              </thead>
  
              <tbody>
                <tr>
                  <td>Pão de Mel</td>
                  <td>3</td>
                  <td>Wellington</td>
                  <td>19/05/2021</td>
                  <td>R$ 15,00</td>
                </tr>
  
                <tr>
                  <td>Gelinho de Leite</td>
                  <td>2</td>
                  <td>Bruna</td>
                  <td>19/05/2021</td>
                  <td>R$ 3,00</td>
                </tr>
  
                <tr>
                  <td>Cone</td>
                  <td>3</td>
                  <td>Guilherme Dias</td>
                  <td>19/05/2021</td>
                  <td>R$ 12,00</td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <div class="pendentes">
            <h2>Vendas Pendentes</h2>
            <table>
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Valor</th>
                  <th>Data pgto.</th>
                </tr>
              </thead>
  
              <tbody>
                <tr>
                  <td>Wellington</td>
                  <td>R$ 15,00</td>
                  <td>19/05/2021</td>
                </tr>
  
                <tr>
                  <td>Bruna</td>
                  <td>R$ 3,00</td>
                  <td>19/05/2021</td>
                </tr>
  
                <tr>
                  <td>Guilherme Dias</td>
                  <td>R$ 12,00</td>
                  <td>19/05/2021</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>
      
      <div class="modal">
        <form action="./app/usuario/login.php" method="POST">
          <h2>Cadastrar Venda</h2>

          <label for="data">Data</label>
          <input type="date" name="data" id="data">
          
          <label for="produto">Produto</label>
          <select name="produto" id="produto">
            <option value="0" selected>Selecione</option>
            <option value="1">Pão de Mel</option>
            <option value="2">Cone</option>
            <option value="3">Trufa</option>
          </select>

          <label for="qtde">Quantidade</label>
          <input type="number" name="qtde" id="qtde">

          <label for="cliente">Cliente</label>
          <select name="cliente" id="cliente">
            <option value="0" selected>Selecione</option>
            <option value="1">João</option>
            <option value="2">Emerson</option>
            <option value="3">Josefina</option>
          </select>

          <label for="status">Status de Pagamento</label>
          <select name="status" id="status">
            <option value="0">Pago</option>
            <option value="1">A pagar</option>
          </select>
  
          <label for="data">Data de Pagamento</label>
          <input type="date" name="data" id="data">
  
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