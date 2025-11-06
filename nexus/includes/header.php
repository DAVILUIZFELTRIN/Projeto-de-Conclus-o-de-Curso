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
        <div class="container banner-content">
            <span class="banner-text">Sua empresa conectada ao cuidado com a saúde mental!</span>
            <button class="btn-proposta" onclick="window.location.href='formulario.php'">Solicite uma proposta!</button>
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
                <button class="nav-btn" onclick="window.location.href='quem-somos.php'">Quem somos</button>
                <button class="nav-btn" onclick="window.location.href='lei-nr1.php'">Lei NR-1</button>
                <button class="nav-btn" onclick="window.location.href='servicos.php'">Serviços</button>
                <button class="nav-btn" onclick="window.location.href='entrar.php'">Entrar</button>
                <button class="nav-btn" onclick="window.location.href='funcionarios.php'">Para Funcionários</button>
            </div>
        </div>
    </nav>