<?php 

// Iniciar a sessão
session_start();


// Incluir o arquivo de conexão com o banco
require_once "../conexao.php";
require_once "include/menu_adm.php";
  
// Variáveis para mensagens
$sucesso = "";
$erro = "";

// Buscar todos os livros para listar
$sql = "SELECT id_livro, nome_livro, autor, publicado, genero, preco_livro, imagem_livro, descricao_livro, quantidade_livro, livro_criado_em FROM livro ORDER BY id_livro  DESC";
$livros = mysqli_query($conexao, $sql);
?>

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

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    <div class="cabecalho-pagina">
      <h1>Catálogo de Livros</h1>
      <a href="cadastro_livro.php" class="btn-novo">+ Novo Livro</a>
    </div>
    <div class="secao-tabela">
      <table>
        <thead>
          <tr>
            <th style="width: 60px;">Capa</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Publicado</th>
            <th>Gênero</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php  while ($u = mysqli_fetch_assoc($livros)): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3">
                            <?php if (!empty($u["imagem_livro"])): ?>
                                <img src="../uploads/capas/<?= $u["imagem_livro"] ?>"
                                    width="60">
                            <?php else: ?>
                                Sem imagem
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3"><?php echo $u["nome_livro"]; ?></td>
                            <td class="px-4 py-3 text-gray-500"><?php echo $u["autor"]; ?></td>
                            <td class="px-4 py-3 text-gray-500"><?php echo $u["publicado"]; ?></td>
                            <td class="px-4 py-3 text-gray-500"><?php echo $u["genero"]; ?></td>
                            <td class="px-4 py-3 text-gray-500"><?php echo $u["preco_livro"]; ?></td>
                            <td class="px-4 py-3 ">
                            <a href="delete_livros.php?deletar=<?php echo $u['id_livro']; ?>&tabela=livro&pagina=listar_livros.php" onclick="return confirm('Tem certeza?');" 
                            class="flex items-center px-6 py-3 text-red-900 hover:text-red-700 tex t-lg">
                                🗑️
                                Excluir
                                </a>
                                <a href="cadastro_livro.php?editar=<?= $u['id_livro']?>"
                                class="flex items-center px-6 py-3 text-blue-600 hover:text-red-500">
                                📝 
                                Editar
                            </a>
                            </td>
                            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>