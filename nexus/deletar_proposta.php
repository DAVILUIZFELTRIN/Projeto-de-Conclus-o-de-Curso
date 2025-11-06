<?php
include 'includes/conexao.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID da proposta não especificado.'); window.location.href='listar_propostas.php';</script>";
    exit();
}

$id_proposta = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM proposta WHERE id_proposta = ?");
$stmt->bind_param("i", $id_proposta);

if ($stmt->execute()) {
    echo "<script>alert('Proposta deletada com sucesso!'); window.location.href='listar_propostas.php';</script>";
} else {
    echo "<script>alert('Erro ao deletar proposta: " . $stmt->error . "'); window.location.href='listar_propostas.php';</script>";
}

$stmt->close();
$conn->close();
?>
