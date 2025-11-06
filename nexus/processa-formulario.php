<?php
include 'includes/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $nome_empresa = $_POST["nome_empresa"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $numero_de_funcionarios = $_POST["numero_de_funcionarios"];
    $porque_procura = $_POST["porque_procura"];

    // Inserir dados na tabela 'proposta'
    $stmt = $conn->prepare("INSERT INTO proposta (nome, nome_empresa, email, telefone, numero_de_funcionarios, porque_procura) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $nome, $nome_empresa, $email, $telefone, $numero_de_funcionarios, $porque_procura);

    if ($stmt->execute()) {
        echo "<script>alert('Proposta enviada com sucesso! Em breve entraremos em contato.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao enviar proposta: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
