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
    $genero = $_FILES["genero"];
    $preco_livro = ["preco_livro"];
    $imagem_livro= ["imagem_livro"];
    $descricao_livro=["descricao_livro"];
    $quantidade_livro=["quantidade_livro"];


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
    
$sqlcurform = "SELECT id_livro,nome_livro, autor, publicado, genero, preco_livro, imagem_livro, descricao_livro, quantidade_livro, prod_criado_em FROM livro ORDER BY id_livro DESC";
$results = mysqli_query($conexao, $sqlcurform);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Módulo — Admin | EAD SENAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { senai: { red:'#C0392B', blue:'#34679A', 'blue-dark':'#2C5A85', orange:'#E67E22', green:'#27AE60' } } } }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .nav-link { display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:6px; font-size:13px; cursor:pointer; transition:background .15s; color:#cbd5e1; }
        .nav-link:hover { background:rgba(255,255,255,.08); color:#fff; }
        .nav-link.active { background:rgba(255,255,255,.15); color:#fff; font-weight:600; }
        .form-input { width:100%; border:1px solid #d1d5db; border-radius:8px; padding:10px 14px; font-size:14px; outline:none; transition:border .15s; }
        .form-input:focus { border-color:#34679A; box-shadow:0 0 0 3px rgba(52,103,154,.15); }
        .form-label { display:block; font-size:12px; font-weight:600; color:#6b7280; margin-bottom:6px; text-transform:uppercase; letter-spacing:.05em; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <main class="flex-1 flex flex-col">
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="flex items-center gap-2 text-xs text-gray-400 mb-1">
                <a href="cursos.php" class="hover:text-senai-blue">Cursos</a> ›
                <a href="modulos.php" class="hover:text-senai-blue">Módulos</a> ›
                <span class="text-gray-700 font-semibold">Editar Módulo</span>
            </div>
            <h1 class="text-xl font-extrabold text-gray-800">Editar Módulo</h1>
        </div>
        <div class="p-6 flex-1 max-w-xl">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <form action="cadastro.php" method="post">

                <div class="mb-5">
                        <span class="block mb-2 font-semibold text-gray-700">Imagem de Capa</span>
                        
                        <label for="input-imagem" class="block border-2 border-dashed border-gray-300 rounded-xl p-5 text-center hover:border-blue-500 transition cursor-pointer bg-gray-50">
                            
                            <div class="bg-gradient-to-br from-blue-500 to-blue-700 w-32 h-20 rounded-lg mx-auto mb-3 flex items-center justify-center overflow-hidden">
                                
                                <img id="img-preview" 
                                    src="uploads/<?= htmlspecialchars($nomeImagem ?? '') ?>" 
                                    alt="Pré-visualização da capa"
                                    class="<?= !empty($nomeImagem) ? '' : 'hidden' ?> w-full h-full object-cover">
                                
                                <span id="placeholder-text" 
                                class="<?= !empty($nomeImagem) ? 'hidden' : '' ?> text-3xl text-white">
                                
                                    <img id="imgedit" 
                                    src="uploads/<?= htmlspecialchars($editando["imagem"] ?? '') ?>"
                                    alt="Pré-visualização da capa"
                                    class="<?= !empty($editando["imagem"]) ? '' : 'hidden' ?> w-full h-full object-cover">
                                </span>
                                
                            </div>

                            <input type="file" name="imagem" id="input-imagem" accept="image/*" class="hidden" onchange="previewFile()">
                            
                            <p class="text-xs text-gray-500">Clique para selecionar uma nova imagem</p>
                        </label>
                    </div>

                    <script>
                    /**
                    * Reads the selected file and updates the preview image on the fly.
                    */
                    function previewFile() {
                        const fileInput = document.getElementById('input-imagem');
                        const previewImg = document.getElementById('img-preview');
                        const placeholderTxt = document.getElementById('placeholder-text');

                        // Check if a file was actually selected
                        if (fileInput.files && fileInput.files[0]) {
                            const file = fileInput.files[0];
                            
                            // Create a temporary URL for the selected image
                            const imgUrl = URL.createObjectURL(file);
                            
                            // Update the image src and show it
                            previewImg.src = imgUrl;
                            previewImg.classList.remove('hidden');
                            
                            // Hide the placeholder text/initials
                            placeholderTxt.classList.add('hidden');
                            
                            // Optional: Clean up the URL object after the image loads to free memory
                            previewImg.onload = function() {
                                URL.revokeObjectURL(previewImg.src);
                            }
                        }
                    }
                    </script>

                    <div class="mb-4">
                        <label class="form-label">Título do livro *</label>
                        <input type="text" name="nome_livro" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Autor *</label>
                        <input type="text" name="autor" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">publicado *</label>
                        <input type="text" name="publicado" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">quantidade *</label>
                        <input type="number" name="quantidade_livro" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">preço *</label>
                        <input type="number" name="preco_livro" class="form-input">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Genêro *</label>
                        <input type="text" name="genero" class="form-input">
                    </div>


                    <div class="mb-4">
                        <label class="form-label">Descrição (opcional)</label>
                        <textarea name="descricao_livro" rows="3" class="form-input resize-none"></textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-senai-blue text-white font-bold px-5 py-2.5 rounded-lg text-sm hover:bg-senai-blue-dark transition">💾 criar modulo</button>
                        <a href="cadastro.php" class="bg-gray-100 text-gray-600 font-semibold px-5 py-2.5 rounded-lg text-sm hover:bg-gray-200 transition">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>
