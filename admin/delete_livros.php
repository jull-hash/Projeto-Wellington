<?php
require_once "../conexao.php";


// 2. Pega as informações que vieram da URL
$id = $_GET["deletar"];
$tabela = $_GET["tabela"];
$pagina = $_GET["pagina"];


 // Buscar imagem para apagar o arquivo
 $sql = "SELECT imagem_livro FROM $tabela WHERE id_livro = '$id'";
 $res = mysqli_query($conexao, $sql);
 $livro = mysqli_fetch_assoc($res);

  // Apagar arquivo da imagem (se existir)
  if (!empty($livro["imagem"]) && file_exists("../uploads/capas/" . $livro["imagem_livro"])) {
    $caminho = "../uploads/capas/" . $livro["imagem_livro"];

echo "Imagem no banco: " . $livro["imagem_livro"] . "<br>";
echo "Caminho resolvido: " . realpath($caminho) . "<br>";
echo "Arquivo existe? " . (file_exists($caminho) ? "SIM" : "NÃO") . "<br>";
    unlink("../uploads/capas/" . $livro["imagem_livro"]);
}

// Monta o comando de apagar e executa direto
$sql = "DELETE FROM $tabela WHERE id_livro = $id";
mysqli_query($conexao, $sql);

// 4. Volta para a página que pediu a exclusão
header("Location: $pagina");
exit;
?>