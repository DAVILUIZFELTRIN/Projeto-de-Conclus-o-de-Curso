<?php
include 'includes/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_consulta = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM consultas WHERE id_consulta = ?");
    $stmt->bind_param("i", $id_consulta);

    if ($stmt->execute()) {
        echo "<script>alert('Consulta registrada deletada com sucesso!'); window.location.href='listar_consultas_registradas.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar consulta registrada: " . $stmt->error . "'); window.location.href='listar_consultas_registradas.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID da consulta registrada não fornecido.'); window.location.href='listar_consultas_registradas.php';</script>";
}
$conn->close();
?>
