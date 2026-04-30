<?php
session_start();

require_once "../conexao.php";
require_once "include/menu_adm.php";

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gerenciar Usuários — Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    <div class="cabecalho-pagina">
      <h1>Gerenciar Usuários</h1>
      <a href="../cadastro_usuario.html" class="btn-novo">+ Novo Usuário</a>
    </div>
    <div class="secao-tabela">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-weight: 700;">#1</td>
            <td>Admin Teste</td>
            <td>admin@admin.com</td>
            <td>(47) 99999-9999</td>
            <td>
              <div class="acoes-tabela">
                <button class="btn-acao">✏️</button>
                <button class="btn-acao btn-excluir">🗑️</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>