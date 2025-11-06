<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] !== "empresa") {
    header("Location: entrar.php");
    exit;
}
$page_title = "Nexus - Dashboard Empresa";
include 'includes/header.php';
?>

<div class="container">
    <h1>Bem-vindo, Empresa!</h1>
    <p>Este é o dashboard da sua empresa.</p>
    <a href="logout.php">Sair</a>
</div>

<?php include 'includes/footer.php'; ?>
