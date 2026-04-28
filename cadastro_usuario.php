<?php

session_start();

require_once "include/menu_user.php";
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro — Livraria Oliveira</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head> 

  <main class="main-content" style="align-items: flex-start;">
    
    <div class="card-formulario-largo">
      <h1>Criar uma conta</h1>
      
      <form action="" method="POST" onsubmit="prepararEndereco()">
        
        <div class="layout-colunas">
          
          <div class="coluna-form">
            <p class="label-secao">👤 Dados Pessoais</p>
            
            <div class="grid-form">
              <div class="grupo-campo">
                <label>Nome Completo</label>
                <input type="text" id="nome" placeholder="Seu nome completo" required />
              </div>
              <div class="grupo-campo">
                <label>E-mail</label>
                <input type="email" id="email" placeholder="seu@email.com" required />
              </div>
              <div class="grupo-campo">
                <label>Telefone</label>
                <input type="text" id="telefone" placeholder="(00) 00000-0000" maxlength="15" />
              </div>
              <div class="grupo-campo">
                <label>Senha</label>
                <input type="password" id="senha" placeholder="Crie uma senha segura" required />
              </div>
            </div>
          </div>

          <div class="coluna-form">
            <p class="label-secao">📍 Endereço de Entrega</p>
            
            <div class="grid-form">
              <div class="linha-cep">
                <div class="grupo-campo" style="width: 100%;">
                  <label>CEP</label>
                  <input type="text" id="cep" placeholder="00000-000" maxlength="9" />
                </div>
                <button type="button" class="btn-buscar-cep" onclick="buscarCep()">🔍 Buscar CEP</button>
              </div>
              <p class="status-cep" id="status-cep" style="margin-top: -5px;"></p>

              <div class="grupo-campo">
                <label>Rua / Logradouro</label>
                <input type="text" id="rua" placeholder="Preenchido automaticamente" readonly />
              </div>
              
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="grupo-campo">
                  <label>Bairro</label>
                  <input type="text" id="bairro" placeholder="Bairro" readonly />
                </div>
                <div class="grupo-campo">
                  <label>Cidade / UF</label>
                  <input type="text" id="cidade" placeholder="Cidade / Estado" readonly />
                </div>
              </div>

              <div class="grupo-campo">
                <label>Número e Complemento</label>
                <input type="text" id="numero_complemento" placeholder="Ex: 123, Bloco B, Apto 4" required />
              </div>
              <input type="hidden" id="endereco_completo" name="endereco" value="" />
            </div>
          </div>

        </div> <div class="form-footer" style="margin-top: 3rem; border-top: 1px solid var(--bg-input); padding-top: 1.5rem;">
          <a class="link-rodape" href="login.html">Já tem uma conta? Faça login</a>
          <button type="submit" class="btn-primario" style="min-width: 200px;">Finalizar Cadastro</button>
        </div>

      </form>
    </div>

  </main>

  <script>
    /* Máscara de Telefone */
    document.getElementById('telefone').addEventListener('input', function () {
      var v = this.value.replace(/\D/g, '').slice(0, 11);
      if (v.length > 10) v = '(' + v.slice(0, 2) + ') ' + v.slice(2, 7) + '-' + v.slice(7);
      else if (v.length > 6) v = '(' + v.slice(0, 2) + ') ' + v.slice(2, 6) + '-' + v.slice(6);
      else if (v.length > 2) v = '(' + v.slice(0, 2) + ') ' + v.slice(2);
      this.value = v;
    });

    /* Máscara de CEP */
    document.getElementById('cep').addEventListener('input', function () {
      var v = this.value.replace(/\D/g, '').slice(0, 8);
      if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
      this.value = v;
    });

    document.getElementById('cep').addEventListener('keydown', function (e) {
      if (e.key === 'Enter') { e.preventDefault(); buscarCep(); }
    });

    function buscarCep() {
      var cep = document.getElementById('cep').value.replace(/\D/g, '');
      var status = document.getElementById('status-cep');
      if (cep.length !== 8) { status.textContent = '⚠️ Digite um CEP válido.'; return; }
      
      status.textContent = '⏳ Buscando endereço...';
      
      fetch('https://viacep.com.br/ws/' + cep + '/json/')
        .then(res => res.json())
        .then(dados => {
          if (dados.erro) { status.textContent = '❌ CEP não encontrado.'; return; }
          document.getElementById('rua').value = dados.logradouro || '';
          document.getElementById('bairro').value = dados.bairro || '';
          document.getElementById('cidade').value = dados.localidade + ' / ' + dados.uf;
          document.getElementById('numero_complemento').focus();
          status.textContent = '✅ Endereço preenchido!';
          setTimeout(() => status.textContent = '', 3000);
        }).catch(() => status.textContent = '❌ Erro ao conectar.');
    }

    function prepararEndereco() {
      var rua = document.getElementById('rua').value;
      var bairro = document.getElementById('bairro').value;
      var cidade = document.getElementById('cidade').value;
      var numero = document.getElementById('numero_complemento').value;
      document.getElementById('endereco_completo').value = rua + ", " + numero + " - " + bairro + ", " + cidade;
    }
  </script>
</body>
</html>