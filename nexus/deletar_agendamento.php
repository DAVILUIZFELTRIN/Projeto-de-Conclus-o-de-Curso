<?php
include 'includes/conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_agendamento = $_GET['id'];

    // Primeiro, deletar da tabela funcionarios_consultas devido à chave estrangeira
    $stmt_func_consulta = $conn->prepare("DELETE FROM funcionarios_consultas WHERE id_agendamento = ?");
    $stmt_func_consulta->bind_param("i", $id_agendamento);
    $stmt_func_consulta->execute();
    $stmt_func_consulta->close();

    // Em seguida, deletar da tabela agendamento_consulta
    $stmt_agendamento = $conn->prepare("DELETE FROM agendamento_consulta WHERE id_agendamento = ?");
    $stmt_agendamento->bind_param("i", $id_agendamento);

    if ($stmt_agendamento->execute()) {
        echo "<script>alert('Agendamento deletado com sucesso!'); window.location.href='listar_consultas.php';</script>";
    } else {
        echo "<script>alert('Erro ao deletar agendamento: " . $stmt_agendamento->error . "'); window.location.href='listar_consultas.php';</script>";
    }
    $stmt_agendamento->close();
} else {
    echo "<script>alert('ID do agendamento não fornecido.'); window.location.href='listar_consultas.php';</script>";
}
$conn->close();
?>
