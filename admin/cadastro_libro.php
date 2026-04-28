<?php
session_start();
require_once "include/menu_adm.php";

require_once "../conexao.php";

if (isset($_GET["editar"])) {
    $id = $_GET["editar"];
    $sqlcurform = "SELECT * FROM livro WHERE id_livro = '$id'";
    $res = mysqli_query($conexao, $sqlcurform);
    $editando = mysqli_fetch_assoc($res);
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome_livro  = $_POST["nome_livro"];
    $autor = $_POST["autor"];
    $publicado = $_POST["publicado"];
    $genero = $_POST["genero"];
    $preco_livro = $_POST["preco_livro"];
    $imagem_livro= $_POST["imagem_livro"];
    $descricao_livro= $_POST["descricao_livro"];
    $quantidade_livro= $_POST["quantidade_livro"];


    if ($imagem_livro["error"] == 0) {


    $tipospermitidos = ["image/jpeg", "image/png", "image/webp"];
    
    if (!in_array($imagem_livro["type"], $tipospermitidos)){
        $error = "Tipo não permitido. Use JPG, PNG ou WEBP.";
    
    }else{
        $extensao = pathinfo($imagem_livro["name"], PATHINFO_EXTENSION);
        $strimagem_livro= "Curso_". time() . "." . $extensao;
    
        move_uploaded_file($imagem_livro["tmp_name"], "../uploads/capas/". $strimagem_livro);
    }
}    

$sqlcurform = "SELECT * FROM livro WHERE nome_livro = '$nome_livro'";
    $resultado = mysqli_query($conexao,$sqlcurform);
    if (mysqli_num_rows($resultado) > 0 && !$editando ){
        $error = "Este curso já está cadastrado";

    }else{
        if (empty($error)){
            if (!empty($_POST["id"])) {
                $id = $_POST["id"];
                $sqlcurform = "UPDATE livro
                        SET nome_livro='$nome_livro',
                        autor='$autor',
                        publicado='$publicado',
                        genero='$genero',
                        preco_livro='$preco_livro',
                        imagem_livro='$strimagem_livro',
                        descricao_livro='$descricao_livro',
                        quantidade_livro='$quantidade_livro',
                        WHERE id_livro = '$id'";
            }else{
                $sqlcurform = "INSERT INTO livro (nome_livro, autor, publicado, genero, preco_livro, imagem_livro, descricao_livro, quantidade_livro) VALUES ('$nome_livro','$autor','$publicado','$genero','$preco_livro','$strimagem_livro','$descricao_livro','$quantidade_livro')";
            }
            if (mysqli_query($conexao, $sqlcurform)) {
                header("location: cadastro.php");
                exit;
            }else{
                $error = "Erro ao cadastrar curso.";
            }
        }
    }

    if (mysqli_query($conexao, $sqlcurform)) {
        $sucesso = "cliente cadastrado com sucesso!";
        
    } else {
        $error = "Erro ao cadastrar cliente.";
    }
        }
    
$sqlcurform = "SELECT id_livro,nome_livro, autor, publicado, genero, preco_livro, imagem_livro, descricao_livro, quantidade_livro, livro_criado_em FROM livro ORDER BY id_livro DESC";
$results = mysqli_query($conexao, $sqlcurform);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adicionar Livro — Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
 

  <main class="main-content">
    <div class="card-formulario">
      <h1>Adicionar Novo Livro</h1>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="area-upload">
          <input type="file" id="imagem_livro" accept="image/*" onchange="mostrarPreview(event)" required />
          <div class="conteudo-upload" id="texto-upload">
            <span style="font-size: 0.9rem; font-weight: 700;">Adicionar imagem</span>
          </div>
          <img id="preview" class="preview-img" alt="Capa" />
        </div>

        <p class="label-secao">📖 Informações do Livro</p>
        <div class="grid-form">
          <div class="grupo-campo linha-completa">
            <label>Título</label>
            <input type="text" name="nome_livro" placeholder="Ex: O Senhor dos Anéis" required />
          </div>
          <div class="grupo-campo">
            <label>Autor</label>
            <input type="text" placeholder="Ex: J.R.R. Tolkien" required />
          </div>
          <div class="grupo-campo">
            <label>Editora</label>
            <input type="text" placeholder="Ex: HarperCollins" required />
          </div>
          <div class="grupo-campo">
            <label>Quantidade Disponível</label>
            <input type="number" placeholder="Ex: 9" min="0" required />
          </div>
        </div>

        <div class="form-footer" style="margin-top: 2rem;">
          <a class="link-rodape" href="listar_livros.html">← Voltar ao Catálogo</a>
          <button type="submit" class="btn-primario">Adicionar Livro</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    function mostrarPreview(event) {
      var input = event.target;
      var preview = document.getElementById('preview');
      var textoUpload = document.getElementById('texto-upload');
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';   
          textoUpload.style.display = 'none'; 
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>