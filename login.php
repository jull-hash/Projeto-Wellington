<?php
// ============================================
// Arquivo: login.php
// Função: Tela de login e autenticação do usuário
// ============================================

// Iniciar a sessão
session_start();

// Se já está logado, redireciona para o dashboard
if (isset($_SESSION["id_usuario"])) {
    if ($_SESSION["usuario_tipo"] == 'user'){
    header("Location: cadastro_usuario.php");
    }else if ($_SESSION["usuario_tipo"] == 'adm'){
    header("Location: admin/cadastro_libro.php");
    }exit;
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


            // Redirecionar para o dashboard
            if ($_SESSION["usuario_tipo"] == 'user'){
            header("Location: cadastro_usuario.php");
            }else if ($_SESSION["usuario_tipo"] == 'adm'){
            header("Location: admin/cadastro_libro.php");
            }exit;
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

     <form method="POST" action="login.php">

            <!-- Campo Email -->
            <div class="mb-4 grupo-campo">
                <label for="email">
                    Email
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="Digite seu email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Campo Senha -->
            <div class="mb-6 grupo-campo" style="margin-top:5px;">
                <label for="senha">
                    Senha
                </label>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    required
                    placeholder="Digite sua senha"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <?php if (!empty($erro)): ?>
            <div class="msg-erro" style="margin-top: 5px;">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>

            <!-- Botão Entrar -->
            <button
                type="submit"
                class="btn-primario"
                style="width: 100%; margin-top: 2rem;">
                Entrar
            </button>

        </form>


    <div style="margin-top: 2rem; text-align: center; display: flex; flex-direction: column; gap: 0.8rem;">
      <a href="cadastro_usuario.php" class="link-rodape">Não tem uma conta? Cadastre-se</a>
      <a href="loja.php" class="link-rodape" style="font-size: 0.85rem; opacity: 0.8;">← Visitar a loja sem login</a>
    </div>

  </div>

</body>
</html>