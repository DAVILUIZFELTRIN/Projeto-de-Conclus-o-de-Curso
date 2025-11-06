<?php
include 'includes/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_empresa = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM empresas WHERE id_empresa = ?");
    $stmt->bind_param("i", $id_empresa);

    if ($stmt->execute()) {
        echo "<script>alert('Empresa deletada com sucesso!'); window.location.href='listar_empresas.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar empresa: " . $stmt->error . "'); window.location.href='listar_empresas.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID da empresa não fornecido.'); window.location.href='listar_empresas.php';</script>";
}
$conn->close();
?>
