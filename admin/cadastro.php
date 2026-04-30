<?php

session_start();

require_once "../conexao.php";
require_once "include/menu_adm.php";

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cursos — Admin | EAD SENAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { senai: { red:'#C0392B', blue:'#34679A', 'blue-dark':'#2C5A85', orange:'#E67E22', green:'#27AE60' } } } }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .nav-link { display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:6px; font-size:13px; cursor:pointer; transition:background .15s; color:#cbd5e1; }
        .nav-link:hover { background:rgba(255,255,255,.08); color:#fff; }
        .nav-link.active { background:rgba(255,255,255,.15); color:#fff; font-weight:600; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">


    <main class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-gray-800">Gerenciar Cursos</h1>
                <p class="text-sm text-gray-500">Cadastre, edite e organize os cursos da plataforma</p>
            </div>
        
        </div>

        <div class="m-auto p-4">
            <a href="cadastro_libro.php" 
            class="bg-senai-green text-white font-bold px-4 py-2.5 rounded-lg text-sm hover:bg-green-600 transition flex items-center gap-2">
                + Novo livro
            </a>
        </div>
        
        <div class="m-auto p-4">
        <a href="cadastro_prod.php" 
            class="bg-senai-green text-white font-bold px-4 py-2.5 rounded-lg text-sm hover:bg-green-600 transition flex items-center gap-2">
                + Novo produto
            </a>
        </div>

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
    </main>

</body>
</html>