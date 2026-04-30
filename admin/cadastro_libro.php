<?php
session_start();

require_once "../conexao.php";
require_once "include/menu_adm.php";



$error="";
$sucesso="";
$editando= null;

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
    $imagem_livro= $_FILES["imagem_livro"];
    $descricao_livro= $_POST["descricao_livro"];
    $quantidade_livro= $_POST["quantidade_livro"];

$sqlcurform = "SELECT * FROM livro WHERE nome_livro = '$nome_livro'";
    $resultado = mysqli_query($conexao,$sqlcurform);
    if (mysqli_num_rows($resultado) > 0 && !$editando ){
        $error = "Este livro já está cadastrado";

    }else{
      
    if ($imagem_livro["error"] == 0) {


    $tipospermitidos = ["image/jpeg", "image/png", "image/webp"];
    
    if (!in_array($imagem_livro["type"], $tipospermitidos)){
        $error = "Tipo não permitido. Use JPG, PNG ou WEBP.";
    
    }else{
        $extensao = pathinfo($imagem_livro["name"], PATHINFO_EXTENSION);
        $strimagem_livro= "Curso_". time() . "." . $extensao;
    
        move_uploaded_file($imagem_livro["tmp_name"], "uploads/". $strimagem_livro);
    }
}    


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
                        quantidade_livro='$quantidade_livro'
                        WHERE id_livro = '$id'";
            }else{
                $sqlcurform = "INSERT INTO livro (nome_livro, autor, publicado, genero, preco_livro, imagem_livro, descricao_livro, quantidade_livro) VALUES ('$nome_livro','$autor','$publicado','$genero','$preco_livro','$strimagem_livro','$descricao_livro','$quantidade_livro')";
            }
            if (mysqli_query($conexao, $sqlcurform)) {
              $sucesso = "Livro cadastrado com sucesso!";
            }else{
              $sucesso = "Erro ao cadastrar o livro!";
            }
        }
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
  <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>

<div class="p-6 flex-1">

            <!-- MENSAGEM DE SUCESSO -->
            <?php if (!empty($sucesso)): ?>
              <div class="msg-alerta msg-sucesso">
                <?php echo $sucesso; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
            <div class="msg-alerta msg-erro">
                <?php echo $error; ?>
                </div>
            <?php endif; ?>

        </div>

        <
 

  <main class="main-content">
    <div class="card-formulario">
      <h1>Adicionar Novo Livro</h1>
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="area-upload">
          <input type="file" name="imagem_livro" accept="image/*" onchange="mostrarPreview(event)" required />
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
            <input type="text" name="autor" placeholder="Ex: J.R.R. Tolkien" required />
          </div>
          <div class="grupo-campo">
            <label>publicado</label>
            <input type="text" name="publicado" placeholder="Ex: HarperCollins" required />
          </div>
          <div class="grupo-campo">
            <label>genero</label>
            <input type="text" name="genero" placeholder="Ex: HarperCollins" required />
          </div>
          <div class="grupo-campo">
            <label>descricao</label>
            <input type="text" name="descricao_livro" placeholder="Ex: HarperCollins" required />
          </div>
          <div class="grupo-campo">
            <label>preço</label>
            <input type="number" name="preco_livro" placeholder="Ex: HarperCollins" required />
          </div>
          <div class="grupo-campo">
            <label>Quantidade Disponível</label>
            <input type="number" name="quantidade_livro" placeholder="Ex: 9" min="0" required />
          </div>
        </div>

        <div class="form-footer" style="margin-top: 2rem;">
          <a class="link-rodape" href="listar_livros.php">← Voltar ao Catálogo</a>
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