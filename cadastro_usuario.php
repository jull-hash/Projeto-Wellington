<?php

session_start();

require_once "conexao.php";

// Variáveis para mensagens
$sucesso = "";
$erro = "";
$editando= null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $imagem = $_POST["imagem_usuario"];
    $nome = $_POST["nome_usuario"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"]; 
    $telefone = $POST["telefone"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    // Verificar se o email já existe
    if (empty($erro)) {

        // Se veio ID = estamos EDITANDO
        if (!empty($_POST["id"])) {
            $id = $_POST["id"];
            $sql = "UPDATE usuario
                    SET 
                    imagem_usuario = '$imagem',
                    nome_usuario = '$nome',
                    endereco = '$endereco'
                    email = '$email',
                    telefone = '$telefone'
                    senha = '$senha'";
} else {
    // Criptografar a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
}      

    // Inserir o novo usuário
    $sql = "INSERT INTO usuario (imagem_usuario, nome_usuario, endereco, email, telefone, senha) VALUES ('$imagem', '$nome', '$endereco', '$email', '$telefone', '$senhaHash')";
        
    if (mysqli_query($conexao, $sql)) {
        $sucesso = "Usuário cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
}
if (mysqli_num_rows($resultado) > 0) {
    $erro = "Este email já está cadastrado.";
} 
}
