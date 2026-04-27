<?php
session_start();


require_once "../conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adicionar Livro — Admin</title>
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
      <a href="listar_livros.html">Lista de Livros</a>
      <a href="cadastro_livro.html" class="ativo">Adicionar Livro</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Sistema</p>
      <a href="usuarios.html">Gerenciar Usuários</a>
      <a href="../login.html" style="color: #c62828; margin-top: 1rem;">Sair</a>
    </nav>
  </aside>

  <main class="main-content" style="align-items: flex-start;">
    <div class="card-formulario-largo">
      <h1>Adicionar Novo Livro</h1>
      
      <form action="" method="POST" enctype="multipart/form-data">
        
        <div class="layout-colunas">
          
          <div class="coluna-form" style="align-items: center;">
            <p class="label-secao">📸 Capa do Livro</p>
            <div class="area-upload" style="margin: 0; width: 100%; max-width: 250px; height: 350px;">
              <input type="file" id="imagem_livro" name="imagem_livro" accept="image/*" onchange="mostrarPreview(event)" required />
              <div class="conteudo-upload" id="texto-upload">
                <span style="font-size: 0.9rem; font-weight: 700;">Adicionar imagem</span>
              </div>
              <img id="preview" class="preview-img" alt="Capa" />
            </div>
          </div>

          <div class="coluna-form">
            <p class="label-secao">📖 Informações do Livro</p>
            <div class="grid-form">
              <div class="grupo-campo linha-completa">
                <label>Título</label>
                <input type="text" name="titulo" placeholder="Ex: O Senhor dos Anéis" required />
              </div>
              <div class="grupo-campo linha-completa">
                <label>Autor</label>
                <input type="text" name="autor" placeholder="Ex: J.R.R. Tolkien" required />
              </div>
              <div class="grupo-campo">
                <label>Editora</label>
                <input type="text" name="editora" placeholder="Ex: HarperCollins" required />
              </div>
              <div class="grupo-campo">
                <label>Quantidade Disponível</label>