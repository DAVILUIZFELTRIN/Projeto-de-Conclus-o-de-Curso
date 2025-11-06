<?php
include 'includes/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_funcionario = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM funcionarios WHERE id_funcionario = ?");
    $stmt->bind_param("i", $id_funcionario);

    if ($stmt->execute()) {
        echo "<script>alert('Funcionário deletado com sucesso!'); window.location.href='listar_funcionarios.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar funcionário: " . $stmt->error . "'); window.location.href='listar_funcionarios.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID do funcionário não fornecido.'); window.location.href='listar_funcionarios.php';</script>";
}
$conn->close();
?>
