<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] !== "psicologo") {
    header("Location: entrar.php");
    exit;
}
$page_title = "Nexus - Dashboard Psicólogo";
include 'includes/header.php';
?>

<div class="container">
    <h1>Bem-vindo, Psicólogo!</h1>
    <p>Este é o dashboard do psicólogo.</p>
    <a href="logout.php">Sair</a>
</div>

<?php include 'includes/footer.php'; ?>
