<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livraria Oliveira — Loja</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <aside class="sidebar">
    <div class="logo-container">
      <h2>Livraria<br>Oliveira</h2>
    </div>
    <nav class="menu-nav">
      <a href="loja.html" class="ativo">Início / Loja</a>
      <a href="#">Meus Pedidos</a>
      <a href="meu_perfil.html">Meu Perfil</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Categorias</p>
      <a href="#">Ficção</a>
      <a href="#">Terror</a>
      <a href="../login.html" style="color: #c62828; margin-top: 2rem;">Sair</a>
    </nav>
  </aside>

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    <div style="margin-bottom: 1rem;">
      <h1>Explore nosso acervo</h1>
      <p style="color: var(--marrom-claro);">Escolha suas próximas histórias favoritas.</p>
    </div>
    <div class="vitrine-livros">
      <div class="card-produto">
        <div class="capa-container">
          <img src="" alt="Capa" onerror="this.src='https://via.placeholder.com/200x300?text=Livro'">
        </div>
        <p class="titulo-livro">O Senhor dos Anéis</p>
        <p class="autor-livro">J.R.R. Tolkien</p>
        <p class="preco-livro">R$ 59,90</p>
        <button class="btn-comprar">Comprar</button>
      </div>
      <div class="card-produto">
        <div class="capa-container">
          <img src="" alt="Capa" onerror="this.src='https://via.placeholder.com/200x300?text=Livro'">
        </div>
        <p class="titulo-livro">1984</p>
        <p class="autor-livro">George Orwell</p>
        <p class="preco-livro">R$ 34,90</p>
        <button class="btn-comprar">Comprar</button>
      </div>
    </div>
  </main>
</body>
</html>