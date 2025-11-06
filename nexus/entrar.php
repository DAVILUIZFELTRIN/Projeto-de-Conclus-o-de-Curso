<?php
$page_title = "Nexus - Entrar";
include 'includes/header_tela_info.php';
?>



<!-- Página de Login -->
<section class="login-section">
    <div class="container">
       
        <div class="login-container">
            <h1 class="login-title">Entrar</h1>
            <p class="login-subtitle">Escolha um tipo de usuário para entrar!</p>

            <form action="login.php" method="POST" id="loginForm">
                <input type="hidden" name="user_type" id="userTypeInput">
                <div id="loginFields" style="display:none;">
                    <div class="login-form-group"><label for="email">Usuário:</label>
                    <input type="email" id="email" name="email" required class="login-input"></div>
                    <div class="login-form-group"><label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required class="login-input"></div>
                    <button type="submit" class="btn-login-custom">Entrar</button>
                </div>
            </form>

            <div class="user-types">
                <div class="user-type-card" onclick="selectUserType('empresa')">
                    <img src="assets/67-82.svg" alt="Empresa" class="user-icon">
                    <p class="user-label">Empresa</p>
                </div>

                <div class="user-type-card" onclick="selectUserType('psicologo')">
                    <img src="assets/67-87.svg" alt="Psicólogo" class="user-icon">
                    <p class="user-label">Psicólogo</p>
                </div>

                <div class="user-type-card" onclick="selectUserType('administrador')">
                    <img src="assets/67-86.svg" alt="Administrador" class="user-icon">
                    <p class="user-label">Administrador</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function selectUserType(type) {
        document.getElementById('userTypeInput').value = type;
        document.getElementById('loginFields').style.display = 'block';
        // Optionally, hide the user type cards after selection
        document.querySelector('.user-types').style.display = 'none';
    }
</script>

