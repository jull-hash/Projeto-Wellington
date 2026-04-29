<?php
if (isset($_SESSION["id_usuario"])) {
    if ($_SESSION["usuario_tipo"] == 'user'){
        header("Location: ../cadastro_usuario.php");
        }
    }else{
        header("Location: ../login.php");
    }
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

    <body class="bg-gray-100 min-h-screen flex">
    <aside class="sidebar">
    <div class="logo-container">
      <h2>Painel<br>Admin</h2>
    </div>
    <nav class="menu-nav">
      <a href="dashboard.php">Dashboard</a>
      <a href="pedidos.php">Pedidos / Vendas</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Catálogo</p>
      <a href="listar_livros.php">Lista de Livros</a>
      <a href="cadastro_livro.php" class="ativo">Adicionar Livro</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Sistema</p>
      <a href="usuarios.php">Gerenciar Usuários</a>
      <a href="../logout.php" style="color: #c62828; margin-top: 1rem;">Sair</a>
    </nav>
  </aside>
</body>
</html>