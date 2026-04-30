<?php 

session_start();
require_once "include/menu_user.php";
require_once "conexao.php";

// SELECT 
//     usuario.nome_usuario, 
//     livro.titulo_livro, 
//     pedido.id_pedido
// FROM pedido
// JOIN usuario ON pedido.user_id = usuario.id_usuario
// JOIN livro ON pedido.livro_id = livro.id_livro;

$sqlped = "SELECT usuario.nome_usuario, livro.titulo_livro, pedido.id_pedido FROM pedido JOIN usuario ON pedido.user_id = usuario.id_usuario JOIN livro ON pedido.livro_id = livro.id_livro";
$sql = "SELECT id_livro, nome_livro, autor, publicado, genero, preco_livro, imagem_livro, descricao_livro, quantidade_livro, livro_criado_em FROM livro ORDER BY id_livro  DESC";
$livros = mysqli_query($conexao, $sql);
?>
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

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    <div style="margin-bottom: 1rem;">
      <h1>Explore nosso acervo</h1>
      <p style="color: var(--marrom-claro);">Escolha suas próximas histórias favoritas.</p>
    </div>
    <?php  while ($u = mysqli_fetch_assoc($livros)): ?>
    <div class="vitrine-livros">
      <div class="card-produto">
        <div class="capa-container">
          <?php if (!empty($u["imagem_livro"])): ?>
                                <img src="uploads/capas/<?= $u["imagem_livro"] ?>"
                                    width="60">
                            <?php else: ?>
                                Sem imagem
                            <?php endif; ?>
        </div>
        <p class="titulo-livro"><?php echo $u["nome_livro"]; ?></p>
        <p class="autor-livro"><?php echo $u["autor"]; ?></p>
        <p class="preco-livro"><?php echo "R$".$u["preco_livro"]; ?></p>
        <button class="btn-comprar">Comprar</button>
      </div>
    </div>
    <?php endwhile; ?>
  </main>
</body>
</html>