<?php 

// Iniciar a sessão
session_start();


// Incluir o arquivo de conexão com o banco
require_once "../conexao.php";
require_once "include/menu_adm.php";
  
// Variáveis para mensagens
$sucesso = "";
$erro = "";

$editando= null;


if (isset($_GET["editar"])){
    $id_livro = $_GET["editar"];
    $sql = "SELECT * FROM livro WHERE id_livro = $id_livro";
    $res=mysqli_query($conexao,$sql);
    $editando = mysqli_fetch_assoc($res);
}
// Se $editando tiver dados, o formulario vai aparecer preenchido
// Se $editando for null, o formulario aparece vazio (cadastro)


if (empty($error)){
  if (!empty($_POST["id_livro"])) {
      $id_livro = $_POST["id_livro"];
      $sqlcurform = "UPDATE livro
              SET nome_livro='$nome_livro',
              autor='$autor',
              publicado='$publicado',
              genero='$genero',
              preco_livro='$preco_livro',
              imagem_livro='$strimagem_livro',
              descricao_livro='$descricao_livro',
              quantidade_livro='$quantidade_livro'
              WHERE id_livro = '$id_livro'";
  }
}

// Buscar todos os livros para listar
$sql = "SELECT id_livro, imagem_livro, nome_livro, autor, genero, quantidade_livro FROM livro ORDER BY id_livro  DESC";
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
      <a href="cadastro_libro.php" class="btn-novo">+ Novo Livro</a>
    </div>
    <div class="secao-tabela">
      <table>
        <thead>
          <tr>
            <th style="width: 60px;">Capa</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Gênero</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php  while ($u = mysqli_fetch_assoc($livros)): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3"><?php echo $idVisual +=1; ?></td>
                            <td class="px-4 py-3"><?php echo $u["nome_livro"]; ?></td>
                            <td class="px-4 py-3">
                            <?php if (!empty($u["imagem_livro"])): ?>
                                <img src="uploads/<?= $u["imagem_livro"] ?>"
                                    width="60">
                            <?php else: ?>
                                Sem imagem
                            <?php endif; ?>
                        </td>
                            <td class="px-4 py-3 text-gray-500"><?php echo $u["criado_em"]; ?></td>
                            <td class="px-4 py-3 text-gray-500"><?php echo $u["preco_livro"]; ?></td>
                            <td class="px-4 py-3 ">
                            <a href="delete.php?id=<?php echo $u['id_livro']; ?>&tabela=produtos&pagina=cadastro_libro.php" onclick="return confirm('Tem certeza?');" 
                            class="flex items-center px-6 py-3 text-red-900 hover:text-red-700 tex t-lg">
                                🗑️
                                Excluir
                                </a>
                                <a href="editar.php?id_livro=<?= $u['id_livro']?>"
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