<?php
  // Conexão com o BD
  $_dsn = "mysql:host=localhost;dbname=gerenciador_vendas";
  $_user = "root";
  $_senha = "";

  try {
    $conexao = new PDO($_dsn, $_user, $_senha);
  } catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }
  