<?php
$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$banco    = "papelaria";
$idVisual = 0;



$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8mb4");
?>