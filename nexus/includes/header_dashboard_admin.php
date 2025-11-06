<?php include "conexao.php"; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Nexus - Saúde Corporativa'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@400;700&family=Baloo+2:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Banner Superior -->
    <div class="top-banner">
         <button class="btn-voltar" onclick="window.location.href='index.php'">Voltar</button>
        <div class="container banner-content">
            <span class="banner-text">Bem-vindo, Administrador Nexus!</span>
        </div>
    </div>

    <!-- Navegação -->
    <nav class="navbar">
        <div class="container">
            <div class="logo-container">
                <a href="index.php">
                    <img src="assets/6001-2.webp" alt="Nexus Logo" class="logo">
                </a>
            </div>
            <div class="nav-menu">
                <button class="nav-btn" onclick="window.location.href='listar_empresas.php'">Empresas</button>
                <button class="nav-btn" onclick="window.location.href='listar_psicologos.php'">Psicólogos</button>
                <button class="nav-btn" onclick="window.location.href='listar_funcionarios.php'">Consultas solicitadas</button>
                <button class="nav-btn" onclick="window.location.href='listar_consultas.php'">Consultas Agendadas</button>
                <button class="nav-btn" onclick="window.location.href='listar_consultas_registradas.php'">Consultas Registradas</button>
            </div>
        </div>
    </nav>