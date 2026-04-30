<?php


require_once "../conexao.php";


  if ($_SESSION["usuario_tipo"] == 'user'){
     header("Location: ../cadastro_usuario.php");
    }
   

    
     
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastro_usuario.css">
    <!-- Estilos específicos desta página, se houver -->
</head>
 
<body>
 
<aside class="sidebar">
    <div class="logo-container">
      <h2>Painel<br>Admin</h2>
    </div>
    <nav class="menu-nav">
      <a href="dashboard.php">Dashboard</a>
      <a href="vendas.php">Pedidos / Vendas</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Catálogo</p>
      <a href="listar_livros.php" class="ativo">Lista de Livros</a>
      <a href="cadastro_libro.php">Adicionar Livro</a>
      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Sistema</p>
      <a href="gerenciar_usuarios.php">Gerenciar Usuários</a>
      <a href="../login.php " style="color: #c62828; margin-top: 1rem;">Sair</a>
    </nav>
  </aside>

</body>
</html>