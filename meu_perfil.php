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
  <aside class="sidebar">
    <div class="logo-container">
      <h2>Livraria<br>Oliveira</h2>
    </div>
    <nav class="menu-nav">
      <a href="loja.html">Início / Loja</a>
      <a href="#">Meus Pedidos</a>
      <a href="meu_perfil.html" class="ativo">Meu Perfil</a>
      <a href="login.html" style="color: #c62828; margin-top: 2rem;">Sair</a>
    </nav>
  </aside>

  <main class="main-content">
    <div class="card-formulario">
      <div class="cabecalho-perfil">
        <div class="foto-perfil-placeholder">👤</div>
        <div class="info-usuario-topo">
          <h2>Nome do Usuário</h2>
          <p>Membro desde 2026</p>
        </div>
      </div>

      <form action="" method="POST">
        <p class="label-secao">Informações de Acesso</p>
        <div class="grid-form">
          <div class="grupo-campo">
            <label>Nome Completo</label>
            <input type="text" value="Nome do Usuário" required />
          </div>
          <div class="grupo-campo">
            <label>E-mail</label>
            <input type="email" value="usuario@email.com" required />
          </div>
          <div class="grupo-campo">
            <label>Telefone</label>
            <input type="text" value="(00) 00000-0000" />
          </div>
          <div class="grupo-campo">
            <label>Senha</label>
            <input type="password" value="********" disabled style="cursor: not-allowed; opacity: 0.6;" />
          </div>
        </div>

        <hr class="divisor" />
        <p class="label-secao">Endereço Cadastrado</p>
        <div class="grupo-campo linha-completa">
          <label>Endereço Atual</label>
          <input type="text" value="Rua Exemplo, 123" readonly />
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