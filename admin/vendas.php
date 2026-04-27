<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pedidos e Vendas — Admin</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet" />
  
  <link rel="stylesheet" href="../css/style.css" />

  <style>
    /* Estilos específicos para a Tabela de Pedidos */
    .secao-tabela {
      width: 100%;
      background-color: var(--bg-card);
      padding: 1.5rem;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(59, 42, 34, 0.05);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }

    th {
      text-align: left;
      padding: 1rem;
      border-bottom: 2px solid var(--bg-input);
      color: var(--marrom-claro);
      font-size: 0.85rem;
      text-transform: uppercase;
    }

    td {
      padding: 1rem;
      border-bottom: 1px solid var(--bg-input);
      color: var(--marrom-escuro);
      font-size: 0.95rem;
    }

    /* Estilo das Badges de Status */
    .badge-status {
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
    }

    .status-pendente { background-color: #fff3e0; color: #ef6c00; }
    .status-enviado { background-color: #e3f2fd; color: #1565c0; }
    .status-concluido { background-color: #e8f5e9; color: #2e7d32; }

    .btn-visualizar {
      background: none;
      border: 1px solid var(--marrom-claro);
      color: var(--marrom-claro);
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.85rem;
      font-weight: 700;
      transition: all 0.2s;
    }

    .btn-visualizar:hover {
      background-color: var(--marrom-escuro);
      color: var(--bg-card);
      border-color: var(--marrom-escuro);
    }
  </style>
</head>
<body>

  <aside class="sidebar">
    <div class="logo-container">
      <svg width="40" height="40" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 10 C16 13 24 19 24 19 C24 19 32 13 42 10 L42 38 C32 35 24 41 24 41 C24 41 16 35 6 38 Z"
              stroke="var(--marrom-escuro)" stroke-width="2.5" fill="none" stroke-linejoin="round"/>
        <line x1="24" y1="19" x2="24" y2="41" stroke="var(--marrom-escuro)" stroke-width="2.5"/>
      </svg>
      <h2>Painel<br>Admin</h2>
    </div>

    <nav class="menu-nav">
      <a href="dashboard.php">Dashboard</a>
      <a href="pedidos.php" class="ativo">Pedidos / Vendas</a>

      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Catálogo</p>
      
      <a href="listar_livros.php">Lista de Livros</a>
      <a href="cadastro_livro.php">Adicionar Livro</a>
      <a href="#">Categorias</a>

      <p style="font-size: 0.8rem; font-weight: 700; color: var(--marrom-claro); margin: 1rem 0 0.2rem 1rem; text-transform: uppercase;">Sistema</p>
      
      <a href="usuarios.php">Gerenciar Usuários</a>
      <a href="../login.php" style="color: #c62828; margin-top: 1rem;">Sair</a>
    </nav>
  </aside>

  <main class="main-content" style="align-items: flex-start; justify-content: flex-start;">
    
    <h1 style="margin-bottom: 2rem;">Pedidos e Vendas</h1>

    <div class="secao-tabela">
      <table>
        <thead>
          <tr>
            <th>Nº Pedido</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Total</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-weight: 700;">#1024</td>
            <td>Juliana Laura Silva Leite</td>
            <td>23/04/2026</td>
            <td>R$ 145,80</td>
            <td><span class="badge-status status-pendente">Pendente</span></td>
            <td><button class="btn-visualizar">Detalhes</button></td>
          </tr>
          <tr>
            <td style="font-weight: 700;">#1023</td>
            <td>Carlos Alberto Oliveira</td>
            <td>22/04/2026</td>
            <td>R$ 52,20</td>
            <td><span class="badge-status status-enviado">Enviado</span></td>
            <td><button class="btn-visualizar">Detalhes</button></td>
          </tr>
          <tr>
            <td style="font-weight: 700;">#1022</td>
            <td>Ana Beatriz Souza</td>
            <td>21/04/2026</td>
            <td>R$ 210,00</td>
            <td><span class="badge-status status-concluido">Concluído</span></td>
            <td><button class="btn-visualizar">Detalhes</button></td>
          </tr>
          <tr>
            <td style="font-weight: 700;">#1021</td>
            <td>Marcos Mendes</td>
            <td>20/04/2026</td>
            <td>R$ 38,90</td>
            <td><span class="badge-status status-concluido">Concluído</span></td>
            <td><button class="btn-visualizar">Detalhes</button></td>
          </tr>
        </tbody>
      </table>
    </div>

  </main>

</body>
</html>