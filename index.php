<?php

session_start();

//require_once "conexao.php";

// $sql="SELECT * FROM estoque";
//$res = mysqli_query($conexao,$sql);
//$resss = mysqli_fetch_array($res);

//echo $resss;


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

    <form action="admin/dashboard.html" method="POST">
      
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









?>