<?php
include 'includes/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_psicologo = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM psicologos WHERE id_psicologo = ?");
    $stmt->bind_param("i", $id_psicologo);

    if ($stmt->execute()) {
        echo "<script>alert('Psicólogo deletado com sucesso!'); window.location.href='listar_psicologos.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar psicólogo: " . $stmt->error . "'); window.location.href='listar_psicologos.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID do psicólogo não fornecido.'); window.location.href='listar_psicologos.php';</script>";
}
$conn->close();
?>
