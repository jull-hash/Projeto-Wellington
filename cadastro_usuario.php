<?php

session_start();
require_once "conexao.php";

$sucesso  = "";
$erro     = "";
$editando = null;
$idVisual = 1;

// ── EDITAR: carrega dados do usuário pelo GET ──────────────────────
if (isset($_GET["editar"])) {
    $id       = $_GET["editar"];
    $sql      = "SELECT * FROM usuario WHERE id_usuario = $id";
    $res      = mysqli_query($conexao, $sql);
    $editando = mysqli_fetch_assoc($res);
}

// ── POST: salvar (inserir ou atualizar) ───────────────────────────
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $imagem   = $_POST["imagem_usuario"] ?? "";
    $nome     = $_POST["nome_usuario"]   ?? "";
    $endereco = $_POST["endereco"]       ?? "";
    $email    = $_POST["email"]          ?? "";
    $telefone = $_POST["telefone"]       ?? "";
    $senha    = $_POST["senha"]          ?? "";

    // Verifica email duplicado apenas no cadastro novo
    $res_email = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email'");
    if (mysqli_num_rows($res_email) > 0 && empty($_POST["id_usuario"])) {
        $erro = "Este email já está cadastrado.";
    }

    if (empty($erro)) {
        if (!empty($_POST["id_usuario"])) {
            // UPDATE
            $id  = $_POST["id_usuario"];
            $sql = "UPDATE usuario
                    SET imagem_usuario = '$imagem',
                        nome_usuario   = '$nome',
                        endereco       = '$endereco',
                        email          = '$email',
                        telefone       = '$telefone',
                        senha          = '$senha'
                    WHERE id_usuario   = $id";
        } else {
            // INSERT
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (imagem_usuario, nome_usuario, endereco, email, telefone, senha)
                    VALUES ('$imagem', '$nome', '$endereco', '$email', '$telefone', '$senhaHash')";
        }

        if (mysqli_query($conexao, $sql)) {
            $sucesso = "Usuário salvo com sucesso!";
        } else {
            $erro = "Erro ao salvar usuário: " . mysqli_error($conexao);
        }
    }
}

// ── Lista todos os usuários para a tabela ─────────────────────────
$lista_usuarios = mysqli_query($conexao, "SELECT * FROM usuario ORDER BY id_usuario DESC");
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
    <link rel="stylesheet" href="css/cadastro_usuario.css">
</head>
<body>

    <!-- ── SIDEBAR ──────────────────────────────────────────────── -->
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

    <!-- ── MAIN ─────────────────────────────────────────────────── -->
    <main>
        <div class="page-header">
            <h2>Cadastrar Usuário</h2>
            <p>Preencha os dados abaixo para criar um novo usuário no sistema.</p>
        </div>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success"><?php echo $sucesso; ?></div>
        <?php endif; ?>
        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>

        <div class="layout">

            <!-- ── FORMULÁRIO ─────────────────────────────────── -->
            <div class="form-col">
                <div class="card">
                    <div class="card-title">
                        <?= $editando ? "Editar Usuário" : "Novo Usuário" ?>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <?php if ($editando): ?>
                            <input type="hidden" name="id_usuario" value="<?= $editando["id_usuario"] ?>">
                        <?php endif; ?>

                        <!-- Dados pessoais -->
                        <div class="form-grid-2col">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome_usuario"
                                       value="<?= htmlspecialchars($editando["nome_usuario"] ?? "") ?>"
                                       required placeholder="Nome completo" class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Contato</label>
                                <input type="text" id="telefone" name="telefone"
                                       value="<?= htmlspecialchars($editando["telefone"] ?? "") ?>"
                                       required placeholder="(00) 00000-0000" class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email"
                                       value="<?= htmlspecialchars($editando["email"] ?? "") ?>"
                                       required placeholder="exemplo@email.com" class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" id="senha" name="senha"
                                       required placeholder="••••••••" class="form-input">
                            </div>
                        </div>

                        <hr class="section-divider">
                        <div class="section-label">📍 Endereço</div>

                        <!-- Busca de CEP: botão type="button" não submete o form -->
                        <div class="cep-row">
                            <div class="form-group">
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" placeholder="00000-000"
                                       maxlength="9" class="form-input">
                            </div>
                            <button type="button" class="btn-secondary" onclick="buscarCep()">
                                🔍 Buscar
                            </button>
                        </div>
                        <p id="cep-status" class="cep-status"></p>

                        <!-- Campos preenchidos automaticamente pelo JS (readonly) -->
                        <div class="form-grid-2col" style="margin-bottom:18px;">
                            <div class="form-group span-full">
                                <label>Rua / Logradouro</label>
                                <input type="text" id="rua"
                                       placeholder="Preenchido automaticamente"
                                       class="form-input" readonly>
                            </div>
                            <div class="form-group">
                                <label>Bairro</label>
                                <input type="text" id="bairro" placeholder="Bairro"
                                       class="form-input" readonly>
                            </div>
                            <div class="form-group">
                                <label>Cidade / UF</label>
                                <input type="text" id="cidade" placeholder="Cidade"
                                       class="form-input" readonly>
                            </div>

                            <!-- Único campo de endereço salvo no banco -->
                            <div class="form-group span-full">
                                <label for="endereco">Número e Complemento</label>
                                <input type="text" id="endereco" name="endereco"
                                       value="<?= htmlspecialchars($editando["endereco"] ?? "") ?>"
                                       placeholder="Ex: 123, Apto 4" class="form-input">
                            </div>
                        </div>

                        <button type="submit" class="btn-primary">
                            <?= $editando ? "💾 Salvar Alterações" : "✨ Cadastrar Usuário" ?>
                        </button>
                    </form>

                </div>
            </div>

            <!-- ── TABELA ──────────────────────────────────────── -->
            <div class="table-col">
                <div class="card">
                    <div class="card-title">Usuários Cadastrados</div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Criado em</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($u = mysqli_fetch_assoc($lista_usuarios)): ?>
                                    <tr>
                                        <td><span class="id-badge"><?php echo $idVisual++; ?></span></td>
                                        <td><?php echo htmlspecialchars($u["nome_usuario"]); ?></td>
                                        <td style="color:var(--muted)"><?php echo htmlspecialchars($u["email"]); ?></td>
                                        <td style="color:var(--muted);font-size:0.8rem"><?php echo $u["user_criado_em"]; ?></td>
                                        <td>
                                            <div class="actions-cell">
                                                <a href="delete_usuario.php?id=<?= $u['id_usuario'] ?>&tabela=usuario&pagina=cadastro_usuario.php"
                                                   onclick="return confirm('Tem certeza que deseja excluir este usuário?');"
                                                   class="action-link delete">🗑️ Excluir</a>
                                                <a href="cadastro_usuario.php?editar=<?= $u['id_usuario'] ?>"
                                                   class="action-link edit">📝 Editar</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div><!-- /.layout -->
    </main>

    
    <script>
        // Máscara automática no campo CEP
        document.getElementById('cep').addEventListener('input', function () {
            let v = this.value.replace(/\D/g, '').slice(0, 8);
            if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
            this.value = v;
        });

        // Enter no campo CEP dispara a busca
        document.getElementById('cep').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') { e.preventDefault(); buscarCep(); }
        });

        // Busca o CEP na API ViaCEP e preenche os campos
        function buscarCep() {
            const cep    = document.getElementById('cep').value.replace(/\D/g, '');
            const status = document.getElementById('cep-status');

            if (cep.length !== 8) {
                status.textContent = '⚠️ Digite um CEP com 8 dígitos.';
                return;
            }

            status.textContent = '⏳ Buscando...';

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(r => r.json())
                .then(d => {
                    if (d.erro) {
                        status.textContent = '❌ CEP não encontrado.';
                        return;
                    }
                    document.getElementById('rua').value    = d.logradouro ?? '';
                    document.getElementById('bairro').value = d.bairro     ?? '';
                    document.getElementById('cidade').value = `${d.localidade}/${d.uf}`;
                    document.getElementById('endereco').focus();

                    status.textContent = '✅ Endereço encontrado!';
                    setTimeout(() => status.textContent = '', 3000);
                })
                .catch(() => {
                    status.textContent = '❌ Erro ao conectar com ViaCEP.';
                });
        }
    </script>

</body>
</html>