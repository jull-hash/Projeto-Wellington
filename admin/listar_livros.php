<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lista de Livros — Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <aside class="sidebar">
    <div class="logo-container">
      <h2>Painel<br>Admin</h2>
    </div>
    <nav class="menu-nav">
      <a href="dashboard.html">Dashboard</a>
      <a href="pedidos.html">Pedidos / Vendas</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Catálogo</p>
      <a href="listar_livros.html" class="ativo">Lista de Livros</a>
      <a href="cadastro_livro.html">Adicionar Livro</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Sistema</p>
      <a href="usuarios.html">Gerenciar Usuários</a>
      <a href="../login.html" style="color: #c62828; margin-top: 1rem;">Sair</a>
    </nav>
  </aside>

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    <div class="cabecalho-pagina">
      <h1>Catálogo de Livros</h1>
      <a href="cadastro_livro.html" class="btn-novo">+ Novo Livro</a>
    </div>
    <div class="secao-tabela">
      <table>
        <thead>
          <tr>
            <th style="width: 60px;">Capa</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Estoque</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div class="capa-miniatura" style="background-color: #4A769E;"></div></td>
            <td style="font-weight: 700;">O Senhor dos Anéis</td>
            <td>J.R.R. Tolkien</td>
            <td>HarperCollins</td>
            <td>9 un.</td>
            <td>
              <div class="acoes-tabela">
                <button class="btn-acao">✏️</button>
                <button class="btn-acao btn-excluir">🗑️</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>