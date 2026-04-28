<?php
if (isset($_SESSION["id_usuario"])) {
    if ($_SESSION["usuario_tipo"] == 'adm'){
        header("Location: admin/cadastro_libro.php");
        }
    }else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário — Projeto SENAI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

    <body class="bg-gray-100 min-h-screen flex">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h1>Projeto SENAI</h1>
            <span>Painel de controle</span>
        </div>
        <nav>
            <div class="nav-section-label">Menu</div>
            <a href="cadastro_cliente.php"  class="nav-link"><span class="nav-icon">🤑</span> Cadastrar Cliente</a>
            <a href="cadastro_usuario.php"  class="nav-link active"><span class="nav-icon">👤</span> Cadastrar Usuário</a>
            <a href="cadastro_produtos.php" class="nav-link"><span class="nav-icon">📋</span> Cadastrar Produtos</a>
            <div class="nav-section-label" style="margin-top:12px;">Sessão</div>
            <a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Sair</a>
        </nav>
        <div class="sidebar-user">
            <div class="user-avatar">👤</div>
            <div class="user-info">
                <div class="label">Logado como</div>
                <div class="name"><?php echo htmlspecialchars($_SESSION["nome_usuario"]); ?></div>
            </div>
        </div>
    </aside>

</body>
</html>