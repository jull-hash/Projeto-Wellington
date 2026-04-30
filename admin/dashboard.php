<?php
session_start();

require_once "../conexao.php";
require_once "include/menu_adm.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard — Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    <h1 style="margin-bottom: 2rem;">Visão Geral</h1>
    <div class="grid-stats">
      <div class="card-stat">
        <span>Livros em Stock</span>
        <h2>142</h2>
      </div>
      <div class="card-stat" style="border-left-color: #5d4037;">
        <span>Vendas este Mês</span>
        <h2>28</h2>
      </div>
      <div class="card-stat" style="border-left-color: #8d6e63;">
        <span>Novos Clientes</span>
        <h2>12</h2>
      </div>
    </div>
  </main>
</body>
</html>