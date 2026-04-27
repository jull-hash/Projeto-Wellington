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
  <aside class="sidebar">
    <div class="logo-container">
      <h2>Painel<br>Admin</h2>
    </div>
    <nav class="menu-nav">
      <a href="dashboard.html" class="ativo">Dashboard</a>
      <a href="pedidos.html">Pedidos / Vendas</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Catálogo</p>
      <a href="listar_livros.html">Lista de Livros</a>
      <a href="cadastro_livro.html">Adicionar Livro</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Sistema</p>
      <a href="usuarios.html">Gerenciar Usuários</a>
      <a href="../login.html" style="color: #c62828; margin-top: 1rem;">Sair</a>
    </nav>
  </aside>

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