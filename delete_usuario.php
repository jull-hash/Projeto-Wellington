<?php
include 'conexao.php';

// Pega as informações da URL
$id = $_GET["id"];
$tabela = $_GET["tabela"];
$pagina = $_GET["pagina"];
 
// Monta o comando SQL
$sql = "DELETE FROM $tabela WHERE id_usuario = $id";

// Tenta executar. Se der certo, volta pra página. Se der erro, mostra o erro na tela!
if (mysqli_query($conexao, $sql)) {
    header("Location: $pagina");
    exit;
} else {
    // É aqui que a mágica acontece para descobrirmos o problema:
    echo "<h1>Erro ao tentar excluir!</h1>";
    echo "<p>Comando tentado: $sql</p>";
    echo "<p>Erro do Banco de Dados: " . mysqli_error($conexao) . "</p>";
}
?>