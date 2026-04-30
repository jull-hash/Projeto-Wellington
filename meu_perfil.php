<?php
session_start();
require_once "conexao.php";
require_once "include/menu_user.php";

$id = $_SESSION["id_usuario"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome= $_POST["nome_usuario"];
    $email= $_POST["email"];
    $telefone= $_POST["telefone"];

    $email_user = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email' AND id_usuario = '$id'");
    $res_email = mysqli_query($conexao, "SELECT * FROM usuario WHERE email = '$email'");
    if (mysqli_num_rows($res_email) > 0 && !empty($email_user)) {
        $erro = "Este email já está cadastrado.";
    }else{
    if (empty($erro)) {
            $sql = "UPDATE usuario
                    SET nome_usuario   = '$nome',
                        email          = '$email',
                        telefone       = '$telefone'
                    WHERE id_usuario   = '$id'";
        }
    }
    if (mysqli_query($conexao, $sql)) {
            $sucesso = "Usuário salvo com sucesso!";
        } else {
            $erro = "Erro ao salvar usuário: " . mysqli_error($conexao);
        }
}

$sql = "SELECT * FROM usuario where id_usuario = '$id'";
$user= mysqli_query($conexao, $sql);
$u = mysqli_fetch_assoc($user);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meu Perfil — Livraria</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="p-6 flex-1">

            <!-- MENSAGEM DE SUCESSO -->
            <?php if (!empty($sucesso)): ?>
            <div class="bg-green-50 border border-green-300 text-green-700 rounded-lg p-3 mb-5 flex items-center gap-2 text-sm">
                <span class="font-bold text-base">✓</span>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php echo $sucesso; ?>
            </div>
                <button class="ml-auto text-green-400 hover:text-green-700 text-lg leading-none">×</button>
            </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
            <div class="bg-green-50 border border-green-300 text-green-700 rounded-lg p-3 mb-5 flex items-center gap-2 text-sm">
                <span class="font-bold text-base">✓</span>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php echo $error; ?>
            </div>
                <button class="ml-auto text-green-400 hover:text-green-700 text-lg leading-none">×</button>
            </div>
            <?php endif; ?>

        </div>

  <main class="main-content">
    <div class="card-formulario">
      <div class="cabecalho-perfil">
        <div class="foto-perfil-placeholder" 
            style="background-image: url('<?php echo $u['imagem_usuario']; ?>'); background-size: cover; background-position: center;"> 
            <?php if (!empty($u["imagem_usuario"])): ?>
                                <img src="uploads/fotos/<?= $u["imagem_usuario"] ?>"
                                class="foto-perfil-placeholder">
                            <?php else: ?>
                                Sem imagem
                            <?php endif; ?>
        </div>
        <div class="info-usuario-topo">
          <h2>Nome do Usuário</h2>
          <?php $ano = substr($u["user_criado_em"],0,4)?>
          <p>Membro desde <?= $ano ?></p>
        </div>
      </div>

      <form action="" method="POST">
        <p class="label-secao">Informações de Acesso</p>
        <div class="grid-form">
          <div class="grupo-campo">
            <label>Nome Completo</label>
            <input type="text" name="nome_usuario" placeholder="<?=$u["nome_usuario"] ?>" required />
          </div>
          <div class="grupo-campo">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="<?= $u["email"] ?>" required />
          </div>
          <div class="grupo-campo">
            <label>Telefone</label>
            <input type="text" name="telefone" maxlength="11" minlength="11" placeholder="<?= $u["telefone"]?>" />
          </div>
          <div class="grupo-campo">
            <label>Senha</label>
            <input type="password" placeholder="********" disabled style="cursor: not-allowed; opacity: 0.6;" />
          </div>
        </div>

        <hr class="divisor" />
        <p class="label-secao">Endereço Cadastrado</p>
        <div class="grupo-campo linha-completa">
          <label>Endereço Atual</label>
          <input type="text" value="<?= $u["endereco"]?>" readonly />
        </div>

        <div class="form-footer">
          <p style="font-size: 0.8rem; color: var(--marrom-claro);">Para alterar o endereço, faça um novo pedido.</p>
          <button type="submit" class="btn-primario">Salvar Alterações</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>