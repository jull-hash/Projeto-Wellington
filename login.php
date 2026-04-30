<?php
// ============================================
// Arquivo: login.php
// Função: Tela de login e autenticação do usuário
// ============================================

// Iniciar a sessão
session_start();

// Se já está logado, redireciona para o dashboard
if (isset($_SESSION["id_usuario"])) {
   header("Location: cadastro_usuario.php");
   exit;
}

// Incluir o arquivo de conexão com o banco
require_once "conexao.php";

// Variável para armazenar mensagem de erro
$erro = "";

// Verificar se o formulário foi enviado (method POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Receber os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Buscar o usuário no banco pelo email
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);

    // Verificar se encontrou o usuário
    if ($usuario = mysqli_fetch_assoc($resultado)) {

        // Verificar se a senha está correta
        if (password_verify($senha, $usuario["senha"])) {
            // Guardar dados do usuário na sessão
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["nome_usuario"] = $usuario["nome_usuario"];
            $_SESSION["email_usuario"] = $usuario["email"];
            $_SESSION["usuario_tipo"] = $usuario["tipo"];

           
              if ($usuario["tipo"] == "user"){
              header("Location: loja.php");
            }
              if ($usuario["tipo"] == "adm"){
              header("Location: admin/dashboard.php");
            }
        } else {
            $erro = "Email ou senha incorretos.";
        }
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Entrar — Livraria Oliveira</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body style="justify-content: center; align-items: center; padding: 2rem;">

  <div class="card-formulario" style="max-width: 400px; padding: 3rem 2rem; width: 100%;">
    
    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem;">
      <svg width="50" height="50" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-bottom: 10px;">
        <path d="M6 10 C16 13 24 19 24 19 C24 19 32 13 42 10 L42 38 C32 35 24 41 24 41 C24 41 16 35 6 38 Z"
              stroke="var(--marrom-escuro)" stroke-width="2.5" fill="none" stroke-linejoin="round"/>
        <line x1="24" y1="19" x2="24" y2="41" stroke="var(--marrom-escuro)" stroke-width="2.5"/>
      </svg>
      <h1 style="margin-bottom: 0.2rem; font-size: 1.6rem;">Livraria Oliveira</h1>
      <p style="color: var(--marrom-claro); font-size: 0.9rem;">Acesse sua conta</p>
    </div>

    <form action=" " method="POST">
      
      <div class="grupo-campo" style="margin-bottom: 1.2rem;">
        <label>E-mail</label>
        <input type="email" name="email" placeholder="seu@email.com" required style="width: 100%;" />
      </div>

      <div class="grupo-campo" style="margin-bottom: 2rem;">
        <label>Senha</label>
        <input type="password" name="senha" placeholder="Sua senha secreta" required style="width: 100%;" />
      </div>

      <button type="submit" class="btn-primario" style="width: 100%;">Entrar no Sistema</button>
      
    </form>

    <div style="margin-top: 2rem; text-align: center; display: flex; flex-direction: column; gap: 0.8rem;">
      <a href="cadastro_usuario.html" class="link-rodape">Não tem uma conta? Cadastre-se</a>
      <a href="loja.html" class="link-rodape" style="font-size: 0.85rem; opacity: 0.8;">← Visitar a loja sem login</a>
    </div>

  </div>

</body>
</html>